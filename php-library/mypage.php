<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>図書管理システム</title>
    <style>
      /* ナビゲーションバーのロゴの指定 */
      .navbar-brand {
        background: url("https://user-images.githubusercontent.com/70254894/100948522-5d5b0e80-354b-11eb-9a4b-82e0ebb5ef42.png") no-repeat left center;
        background-size: contain;
        height: 70px;
        width: 70px;
      }

      @media screen and (min-width: 576px) {
        li+ li {
          border-left: 1px solid #BBBBBB;
        }
       }

       .col-sm-3 {
         display:inline-block;
         margin: 20px 45px;
       }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-light">
      <a class="navbar-brand" href="#" class="rounded-circle"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#home">　Home　</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">　About　</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#myPage">　My Page　</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#signup">　Sign up　</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#logout">　Logout　</a>
          </li>
        </ul>
      </div>
    </nav>

    <main>
    <h1 class="text-center">My Page</h1><br>

    <?php
    // DB接続に必要なデータを変数に代入
    $dsn='mysql:host=localhost;dbname=acrovision_library';
    $user='root';
    $password='root';

    try{
      $db=new PDO($dsn,$user,$password);
      $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

      // DBと接続し、登録履歴に必要なデータの抽出
      // user_idが確認したいuserであれば抽出（修正が必要、現在はuser_idが1の場合抽出されるようなっている）
      $sql1="SELECT books.id, title, img, comment
      FROM books LEFT JOIN book_history
      ON books.id = book_history.book_id
      WHERE user_id = 1";
      $stmt1=$db->query($sql1);
      $stmt1->execute();

      // DBと接続し、読破履歴に必要なデータの抽出
      // user_idが確認したいuserで、book_historyテーブルのcreated_atカラムよりupdated_atカラムが新しい日付であれば抽出
      // WHERE以降修正が必要（修正が必要、現在はuser_idが1の場合抽出されるようなっている）
      $sql2="SELECT books.id, title, img, comment
      FROM books LEFT JOIN book_history
      ON books.id = book_history.book_id
      WHERE user_id = 1
      AND book_history.created_at < book_history.updated_at";
      $stmt2=$db->query($sql2);
      $stmt2->execute();

    }catch(PDOException $error){
      echo "error".$error->getMessage();
    }
    // SQLより取り出したデータを配列に格納
    $t_data = $stmt1->fetchAll();
    $t_bid = array_column($t_data, 'id');
    $t_title = array_column($t_data, 'title');
    $t_img = array_column($t_data, 'img');
    $t_comment = array_column($t_data, 'comment');

    $d_data = $stmt2->fetchAll();
    $d_bid = array_column($d_data, 'id');
    $d_title = array_column($d_data, 'title');
    $d_img = array_column($d_data, 'img');
    $d_comment = array_column($d_data, 'comment');
    ?>

    <section>
      <!-- ドロップダウンリスト -->
      <div class="dropdown">
        <button type="button" id="dropdown1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 10px 10px;">
          選択してください
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdown1">
          <!-- 選択肢 -->
          <a class="dropdown-item" value="全て"> 全て </a>
          <a class="dropdown-item" value="登録履歴"> 登録履歴 </a>
          <a class="dropdown-item" value="読破履歴"> 読破履歴 </a>
        </div>
      </div>
        <div class="touroku py-5 mb-5" style="width:100%; background-color:#F0F8FF;">
            <h3 class="text-center">登録履歴</h3>
              <div class="container">
                <div class="mb-5 row">
                  <!-- $sql1で抜き出したDBのデータを使用し、for文で繰り返し表示 -->
                    <?php for ($i=0; $i<count($t_bid); $i++) : ?>
                    <div class="col-sm-3 bg-white">
                      <img src="<?php echo $t_img[$i] ?>" class="w-100" >
                      <p><?php echo $t_title[$i] ?></p>
                      <p><?php echo $t_comment[$i] ?></p>
                    </div>
                    <?php endfor; ?>
                </div>
              </div>
          </div>
          <div class="dokuha py-5 mb-5" style="width:100%;">
            <h3 class="text-center">読破履歴</h3>
              <div class="container">
                <div class="mb-5 row">
                  <!-- $sql2で抜き出したDBのデータを使用し、for文で繰り返し表示 -->
                    <?php for ($i=0; $i<count($d_bid); $i++) : ?>
                    <div class="col-sm-3" style="background-color:#F0F8FF;">
                      <img src="<?php echo $d_img[$i] ?>" class="w-100" >
                      <p><?php echo $d_title[$i] ?></p>
                      <p><?php echo $d_comment[$i] ?></p>
                    </div>
                    <?php endfor; ?>
                </div>
              </div>
          </div>
    </section>
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript">
      //myPage.phpを表示した際の表示（登録履歴、読破履歴共に表示しない）
      window.onload = function() {
        $('.touroku').css('display', 'none');
        $('.dokuha').css('display', 'none');
      }

      $('.dropdown-menu .dropdown-item').click(function(){
        // ドロップダウンで選択した項目をボタンに表示
          var visibleItem = $('.dropdown-toggle', $(this).closest('.dropdown'));
          visibleItem.text($(this).attr('value'));

          var dropdown_val = $(this).attr('value');
          // ドロップダウンで選択した項目に応じて、画面表示を変更する
          // 「全て」を選択した場合、登録履歴、読破履歴共に表示
          if (dropdown_val == "全て") {
            $('.touroku').css('display', 'block');
            $('.dokuha').css('display', 'block');
          // 「登録履歴」を選択した場合、登録履歴は表示、読破履歴は表示しない
          }else if(dropdown_val == "登録履歴") {
            $('.touroku').css('display', 'block');
            $('.dokuha').css('display', 'none');
          // 「読破履歴」を選択した場合、登録履歴は表示しない、読破履歴は表示
          }else if(dropdown_val == "読破履歴") {
            $('.touroku').css('display', 'none');
            $('.dokuha').css('display', 'block');
          }
      });
    </script>
  </body>
</html>
