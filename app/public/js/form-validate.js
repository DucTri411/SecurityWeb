// Minimal client-side validation
(function () {
  function on(el, evt, fn) { if (el) el.addEventListener(evt, fn); }
  function showError(input, msg) {
    let el = input.nextElementSibling;
    if (!el || !el.classList || !el.classList.contains('field-error')) {
      el = document.createElement('div');
      el.className = 'field-error';
      input.parentNode.insertBefore(el, input.nextSibling);
    }
    el.textContent = msg || '';
  }
  function clearError(input) {
    const el = input.nextElementSibling;
    if (el && el.classList && el.classList.contains('field-error')) el.textContent = '';
  }
  function validEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form').forEach(function (form) {
      on(form, 'submit', function (e) {
        let ok = true;
        form.querySelectorAll('input[required],textarea[required],select[required]').forEach(function (input) {
          clearError(input);
          if (!input.value.trim()) { ok = false; showError(input, 'Vui lòng không bỏ trống'); }
          if (input.type === 'email' && input.value && !validEmail(input.value)) { ok = false; showError(input, 'Email không hợp lệ'); }
          if (input.name === 'password' && input.value && input.value.length < 8) { ok = false; showError(input, 'Mật khẩu tối thiểu 8 ký tự'); }
        });
        if (!ok) e.preventDefault();
      });
    });
  });
})();


