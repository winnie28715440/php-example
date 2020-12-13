<?php
if (!isset($pageName)) $pageName = '';
?>

<style>
  .navbar .nav-item.active {
    background-color: #a3e871a1;
    border-radius: 10px;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?= WEB_ROOT ?>index_.php">Index</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?= $pageName == 'ab-list' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= WEB_ROOT ?>ab-list.php">通訊錄列表 <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?= $pageName == 'ab-insert' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= WEB_ROOT ?>ab-insert.php">新增通訊錄列表 <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>

    </div>
  </div>
</nav>