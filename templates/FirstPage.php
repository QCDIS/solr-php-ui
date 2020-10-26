<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= t('Search') . ($query ? ': ' . htmlspecialchars($query) : '') ?></title>
  <link rel="alternate" type="application/rss+xml" title="RSS" href="<?= $link_rss ?>">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Custom fonts for this template-->
  <link href="UI/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="UI/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/app.css" type="text/css"/>

<style>

.centerSearchBox {
  position: absolute;
  left: 50%;
  top: 35%;
  transform: translate(-50%, -50%);
  width:100%;
  text-align:center;
  padding: 10px;
}
</style>

</head>
<body id="page-top" style="background-color:white;">

    <div class="centerSearchBox">
        <img src="images/envri_logo_final.png" style="width:200px; height:155px;">
        <br /> <br /> <br />
    <div style="display:inline-block;min-width:300px; width:30%;">
        <form id="searchform1" accept-charset="utf-8" method="get">
            <div class="input-group" style="border:solid 1px blue; border-radius:5px;">
              <input type="text" class="form-control bg-light border-0 big" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" id="q" name="q" type="text"
               value="<?php echo htmlspecialchars($query, ENT_QUOTES, 'utf-8'); ?>" required=""  oninvalid="this.setCustomValidity('The search query is empty!')" oninput="setCustomValidity('')"/>
              <div class="input-group-append">
                <button class="btn btn-primary" id="submit" type="submit" value="<?= t("Search"); ?>" onclick='waiting_on();' style="border:solid 1px ;">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
        </form>
    </div>
       <br /> <br /> <br />
</body>
</html>