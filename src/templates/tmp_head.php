<!DOCTYPE html>
<html lang="en">

<meta charset="utf-8">
<link rel="stylesheet" href="assets/bootstrap-3.3.6-dist/css/bootstrap.min.css"
      type="text/css">
<link rel="stylesheet" href="assets/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css"
      type="text/css">
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-collapse collapse" style="height: 1px;">
            <ul class="nav navbar-nav">
                <li><a href="http://192.168.100.220/">Home</a></li>
                <li><a href="http://192.168.100.220/?action=OtherBlogs">Другие блоги</a></li>
            </ul>
            <div class="navbar-header" style="position: absolute; right: 200px">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?= $title; ?></a>
            </div>
        </div>

    </div>
</div>
</html>