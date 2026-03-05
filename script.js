const navbar = document.querySelector(".navbar");
const menuBtn = document.querySelector("#menu-icon");

const searchWrap = document.querySelector("#search-box");
const searchBtn = document.querySelector("#search-icon");
const searchClose = document.querySelector("#search-close");

const yearEl = document.querySelector("#year");
if (yearEl) yearEl.textContent = new Date().getFullYear();

function setExpanded(el, value) {
  if (!el) return;
  el.setAttribute("aria-expanded", value ? "true" : "false");
}

function closeMenu() {
  navbar?.classList.remove("active");
  setExpanded(menuBtn, false);
}

function closeSearch() {
  searchWrap?.classList.remove("active");
  setExpanded(searchBtn, false);
}

function openSearch() {
  closeMenu();
  searchWrap?.classList.add("active");
  setExpanded(searchBtn, true);
  const input = searchWrap?.querySelector('input[type="search"]');
  input?.focus();
}

menuBtn?.addEventListener("click", () => {
  const willOpen = !navbar?.classList.contains("active");
  navbar?.classList.toggle("active");
  setExpanded(menuBtn, willOpen);
  if (willOpen) closeSearch();
});

searchBtn?.addEventListener("click", () => {
  const isOpen = searchWrap?.classList.contains("active");
  if (isOpen) closeSearch();
  else openSearch();
});

searchClose?.addEventListener("click", closeSearch);

navbar?.addEventListener("click", (e) => {
  const link = e.target.closest("a");
  if (link) closeMenu();
});

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    closeMenu();
    closeSearch();
  }
});

document.addEventListener("click", (e) => {
  const header = document.querySelector(".site-header");
  const inside = header?.contains(e.target);
  if (!inside) {
    closeMenu();
    closeSearch();
  }
});

window.addEventListener(
  "scroll",
  () => {
    closeMenu();
    closeSearch();
  },
  { passive: true }
);