<?php include('includes/session.php')?>
<?php include('includes/config.php')?>
<?php $get_id = $_GET['edit']; ?>
<?php

 //********************Updation********************
    if(isset($_POST['update'])){

        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $note=mysqli_real_escape_string($conn,$_POST['note']);

        // make sql query
        $query = "UPDATE notes SET title=\"$title\",note=\"$note\",last_updated_at=CURRENT_TIMESTAMP WHERE note_id = \"$get_id\" ";

        if(mysqli_query($conn, $query)){
        	echo "<script>alert('Note Updated Successfully');</script>";
      		echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
        }else{
            //failure
            echo 'query error: '. mysqli_error($conn);
        }

    }

    //********************Selection********************
     $query = "SELECT note_id,title,note,time_in FROM notes WHERE note_id = \"$get_id\" ";

    if(mysqli_query($conn, $query)){

        // get the query result
        $result = mysqli_query($conn, $query);

        // fetch result in array format
        $notesArray= mysqli_fetch_all($result , MYSQLI_ASSOC);

        // print_r($notesArray);

    }else{
        //failure
        echo 'query error: '. mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Notebook | Web Application</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />

</head>
<body>
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="images/Notes icon.jpg" class="m-r-sm">College Notes</a>
       
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="dropdown">
          <?php $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
                $row = mysqli_fetch_array($query);
            ?>

          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="images/profile.jpg">
            </span>
            <?php echo $row['fullName']; ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li class="divider"></li>
            <li>
              <a href="logout.php" data-toggle="ajaxModal" >Logout</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-dark lter aside-md hidden-print nav-xs" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="notebook.php" class="active">
                        <i class="fa fa-pencil icon">
                          <b class="bg-info"></b>
                        </i>
                        <span>Notes</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
          
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="hbox stretch">
                  <aside class="aside-lg lter b-r">
                    <div class="wrapper">
                      <h4 class="m-t-none">Add Note</h4>
                      <form method="POST">
                      	<?php
						$query = mysqli_query($conn,"select * from notes where note_id = '$get_id' ")or die(mysqli_error());
						$row = mysqli_fetch_array($query);
						?>
                        <div class="form-group">
                          <label>Title</label>
                          <input name="title" type="text" placeholder="Title" class="input-sm form-control" value="<?php echo $row['title']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Note</label>
                          <textarea name="note" class="form-control" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......"><?php echo $row['note']; ?></textarea>
                        </div>
                        <div class="m-t-lg"><button class="btn btn-md btn-default btn-info" name="update" type="submit">Update Note</button></div>
                      </form>
                    </div>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activity" data-toggle="tab"><h4 style = "text-transform:uppercase;"><b>Note Details</b></h4></a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li></li>
                            <?php foreach($notesArray as $note){ ?>
                            <li class="list-group-item">
                                <h3 style = "text-transform:uppercase;"><b><?php echo $note['title'] ?></b></h3>
                                <p style="font-size:18px;"><?php echo $note['note']; ?> </p>
                                
                                <?php } ?>
                            </li>
                          </ul>
                        </div>
                        <div class="tab-pane" id="events">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                        <div class="tab-pane" id="interaction">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <!-- <aside class="col-lg-4 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <section class="panel panel-default">
                          
                        </section>
                        <section class="panel clearfix bg-info lter">
                          <!-- <div class="panel-body">
                            <a href="#" class="thumb pull-left m-r">
                              <img src="images/profile.jpg" class="img-circle">
                            </a>
                            <div class="clear">
                              <a href="https://www.youtube.com/channel/UCGnh6Xo-GhfNw4q7w9z1YxA/playlists" target="_blank" class="text-info">@CodeLytical <i class="fa fa-twitter"></i></a>
                              <small class="block text-muted">2,415 followers / 225 tweets</small>
                              <a href="#" class="btn btn-xs btn-success m-t-xs">Subscribe</a>
                            </div>
                          </div> -->
                        </section>
                      </div>
                    </section>
                  </section>              
                </aside> -->
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/libs/underscore-min.js"></script>
<script src="js/libs/backbone-min.js"></script>
<script src="js/libs/backbone.localStorage-min.js"></script>  
<script src="js/libs/moment.min.js"></script>
<!-- Notes -->
<script src="js/apps/notes.js"></script>

</body>
</html>