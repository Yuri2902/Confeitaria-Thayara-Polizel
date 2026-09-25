/**
 * tema.js — troca entre modo claro e escuro
 */

const CHAVE_TEMA = 'thay_tema';

function temaAtual() {
  return document.documentElement.getAttribute('data-tema') || 'claro';
}

function aplicarTema(tema) {
  const html = document.documentElement;

  html.setAttribute('data-tema', tema);
  html.setAttribute('data-bs-theme', tema === 'escuro' ? 'dark' : 'light'); //modo escuro do bootstrap

  try {
    localStorage.setItem(CHAVE_TEMA, tema);
  } catch (e) {
    //navegação anônima pode bloquear o localStorage
  }

  atualizarBotaoTema(tema);
}

function alternarTema() {
  aplicarTema(temaAtual() === 'escuro' ? 'claro' : 'escuro');
}

function atualizarBotaoTema(tema) {
  const btn = document.getElementById('btn-tema');
  if (!btn) return;

  const escuro = tema === 'escuro';

  btn.querySelector('.icone-tema').textContent = escuro ? '☀️' : '🌙';
  btn.querySelector('.texto-tema').textContent = escuro ? 'Modo claro' : 'Modo escuro';
  btn.setAttribute('aria-pressed', escuro ? 'true' : 'false');
  btn.setAttribute('title', escuro ? 'Voltar ao modo claro' : 'Ativar o modo escuro');
}

document.addEventListener('DOMContentLoaded', () => {
  atualizarBotaoTema(temaAtual());

  const btn = document.getElementById('btn-tema');
  if (btn) btn.addEventListener('click', alternarTema);
});

//segue o tema do sistema se a pessoa nunca escolheu
if (window.matchMedia) {
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    let escolhaSalva = null;
    try { escolhaSalva = localStorage.getItem(CHAVE_TEMA); } catch (err) { /* ignora */ }
    if (!escolhaSalva) aplicarTema(e.matches ? 'escuro' : 'claro');
  });
}
