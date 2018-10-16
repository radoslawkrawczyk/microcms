<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="/admin/dashboard">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
              <a class="nav-link" href="/admin/text/add">Add Text</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/text/edit">Edit</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Build menu</a>
            </li>

          </ul>
          <span class="navbar-text">
      <a href="/admin/logout">Logout</a>
    </span>
        </div>
</div>
      </nav>
      <div class="container">        <?php if (empty($content)) { ?>
        <h1>Hello, <?php echo $this->session->user; ?>!</h1>  <?php } ?>
        <div id="content">
        <?php if (!empty($content) && $content === 'text') { $this->load->view('admin/text'); }?>
        <?php if (!empty($content) && $content === 'edit') { $this->load->view('admin/edit'); }?>
        </div>
        <?php if (empty($content)) { ?>
        <p>All your texts are listed in the Texts List in the upper menu.</p>
        <p>To get content of the text send a <strong>GET</strong> request to <code>/api/text/{id}</code> with <code>{id}</code> changed to your resource ID</p>
        <?php } ?>
</div>
</body>
</html>