/**
 * carrinho.js — lógica do carrinho compartilhada entre todas as páginas
 * Armazenado em localStorage como array de { id, nome, preco, img, qtd }
 */

const CHAVE = 'thay_carrinho';

function carregarCarrinho() {
  try {
    return JSON.parse(localStorage.getItem(CHAVE)) || [];
  } catch { return []; }
}

function salvarCarrinho(itens) {
  localStorage.setItem(CHAVE, JSON.stringify(itens));
}

function totalItens() {
  return carregarCarrinho().reduce((s, i) => s + i.qtd, 0);
}

function adicionarItem(produto) {
  const itens = carregarCarrinho();
  const existente = itens.find(i => i.id === produto.id);
  if (existente) {
    existente.qtd += produto.qtd || 1;
  } else {
    itens.push({ ...produto, qtd: produto.qtd || 1 });
  }
  salvarCarrinho(itens);
  atualizarBadge();
  mostrarToast(`${produto.nome} adicionado ao carrinho!`);
}

function removerItem(id) {
  const itens = carregarCarrinho().filter(i => i.id !== id);
  salvarCarrinho(itens);
  atualizarBadge();
}

function alterarQtd(id, delta) {
  const itens = carregarCarrinho();
  const item = itens.find(i => i.id === id);
  if (!item) return;
  item.qtd = Math.max(0, item.qtd + delta);
  const filtrados = itens.filter(i => i.qtd > 0);
  salvarCarrinho(filtrados);
  atualizarBadge();
  return item.qtd;
}

function limparCarrinho() {
  salvarCarrinho([]);
  atualizarBadge();
}

function totalValor() {
  return carregarCarrinho().reduce((s, i) => s + i.preco * i.qtd, 0);
}

function atualizarBadge() {
  const badge = document.querySelector('.badge-carrinho');
  if (!badge) return;
  const n = totalItens();
  badge.textContent = n > 9 ? '9+' : n;
  badge.style.display = n > 0 ? 'flex' : 'none';
}

function mostrarToast(msg) {
  let toast = document.getElementById('toast-thay');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toast-thay';
    toast.className = 'toast-thay';
    document.body.appendChild(toast);
  }
  toast.textContent = msg;
  toast.classList.add('visivel');
  clearTimeout(toast._timer);
  toast._timer = setTimeout(() => toast.classList.remove('visivel'), 2800);
}

// Hamburguer
function toggleMenu() {
  const nav = document.querySelector('.navbar-thay .nav-links');
  if (nav) nav.classList.toggle('aberto');
}

document.addEventListener('DOMContentLoaded', () => {
  atualizarBadge();
});
