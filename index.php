<?php
  if (isset($_POST['salvar'])) {
    $texto = $_POST['texto'];
    $arquivo = $_POST['arquivo'];
    file_put_contents($arquivo, $texto);
    echo '<script>alert("Salvo com sucesso")</script>';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Editor - Listagem de Arquivos</title>
</head>
<body>
  <?php

    $files = scandir('files');
    for ($i=0; $i < count($files); $i++) { 
      if (is_dir($files[$i])) {
        continue;
      }
      $file_extension = explode('.', $files[$i]);
      if (@$file_extension[1] === 'php') {
  ?>
    <div class="lista-arquivo-single">
        <p><a href="?file=<?php echo $files[$i] ?>"><?php echo $files[$i]; ?></a></p>
    </div>
  <?php
      }
    }

    if(isset($_GET['file']) && file_exists('files/'.$_GET['file'])) {
      echo 'existe o arquivo';
  ?>
    <h2><?php echo 'Editando arquivo: '.$_GET['file'] ?></h2>
    <form action="" method="post">
      <textarea style="width: 500px; height: 400px;" name="texto" id="texto"><?php echo file_get_contents('files/'.$_GET['file']) ?></textarea>
      <hr>
      <input type="hidden" name="arquivo" value="<?php echo 'files/'.$_GET['file'] ?>">
      <input type="submit" value="Salvar" name="salvar">
    </form>
  <?php
    }
  ?>
</body>
</html>