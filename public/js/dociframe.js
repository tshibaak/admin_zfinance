window.contextInfo = {"files":[],"materials":[],"crafts":[]};
// 处理锚点链接跳转（srcDoc iframe 中锚点链接默认行为不正确）
document.addEventListener('click', function(e) {
  var anchor = e.target.closest('a');
  if (anchor) {
    var href = anchor.getAttribute('href');
    if (href && href.startsWith('#')) {
      e.preventDefault();
      var targetId = href.slice(1);
      var target = document.getElementById(targetId);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    }
  }
});