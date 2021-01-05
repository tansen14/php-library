<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>acrovition　書籍管理システム</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/9f015e8d67.js" crossorigin="anonymous"></script>
    <title>サンプルサイト</title>
  </head>
  <body>
  	<div class="serch_container">
  		<form id="form1" action="index.php" method="post">
			<input type="serch" name="search" class="inp serch" placeholder="キーワードを入力" />
			<input id="sbtn1" type="submit" value="検　索" class="inp submit" /></form>
  	</div>
    <?php 
      $search = $_POST['search'];

      $dsn = 'mysql:host=localhost;dbname=acrovision_library';
      $user = 'root';
      $password = 'root';

      if ($search !== "") {
          try {
          $db = new PDO($dsn, $user, $password);
          $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
          $sql = "SELECT title, img, comment FROM books WHERE title LIKE '%" . $search . "%' ";
          $stmt = $db->prepare($sql);
          $stmt->execute();

          $data = $stmt->fetchAll();
          $title = array_column($data, 'title');
          $img = array_column($data, 'img');
          $comment = array_column($data, 'comment');
          } catch (PDOException $error) {
            echo "error" . $error->getMessage();
          }
      }
      echo COUNT($title);
      $count = COUNT($title) / 3;
      $n = 0;
     ?>
     <?php for ($i = 0; $i <= $count; $i++): ?>
      <div class="container-fluid">
        <div class="row">
          <div class="box col-lg-4">
            <?php $n;; ?> 
            <?php if(!(is_null($img[$n]))): ?>
              <div class="box_in left">
                <i class="fas fa-circle fa-4x"></i>
                  <img src="image/dokuha.png" alt="" class="img_dokuha">
                <div class="img_container">
                  <img src="image/<?php echo $img[$n]; ?>" alt="" class="img">
                    <p class="book_title"><?php echo $title[$n]; ?></p>
                    <div class="book_comment_container">
                      <p class="book_comment"><?php echo $comment[$n]; ?></p>  
                    </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
          <div class="box col-lg-4">
            <?php global $n; $n++;?>
            <?php if(!(is_null($img[$n]))): ?>
              <div class="box_in center">
                <i class="fas fa-circle fa-4x"></i>
                <img src="image/dokuha.png" alt="" class="img_dokuha">
                <div class="img_container">
                  <img src="image/<?php echo $img[$n]; ?>" alt="" class="img">
                  <p class="book_title"><?php echo $title[$n]; ?></p>
                    <div class="book_comment_container">
                      <p class="book_comment"><?php echo $comment[$n]; ?></p>  
                    </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
          <div class="box col-lg-4">
            <?php global $n; $n++;?>
            <?php if(!(is_null($img[$n]))): ?>
              <div class="box_in right">
                <i class="fas fa-circle fa-4x"></i>
                <img src="image/dokuha.png" alt="" class="img_dokuha">
                <div class="img_container">
                  <img src="image/<?php echo $img[$n]; ?>" alt="" class="img">
                  <p class="book_title"><?php echo $title[$n]; ?></p>
                    <div class="book_comment_container">
                      <p class="book_comment"><?php echo $comment[$n]; ?></p>  
                    </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php global $n; $n++;?>
    <?php endfor; ?>      
  </body>
</html>


