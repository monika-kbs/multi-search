<?php
require 'init.php';
// ini_set('display_errors', 'On');
// error_reporting(E_ALL | E_STRICT);
$users = $db->query("SELECT users.* FROM users");
if(isset($_GET['filter_type']))
{
  if($_GET['filter_type'] == 'skills')
  {
    $skillID = (int) $_GET['skill'];
    $operator = (string) trim($_GET['operator']);
    if($operator == 'contains')
    {
      $users = $db->query("SELECT users.* FROM users LEFT JOIN user_skills ON users.id = user_skills.user_id and user_skills.skill_id = ? WHERE  user_skills.skill_id is not null", [$skillID]);
    } else {
      $users = $db->query("SELECT users.* FROM users LEFT JOIN user_skills ON users.id = user_skills.user_id and user_skills.skill_id = ? WHERE  user_skills.skill_id is not null", [$skillID]);      
    }
  }
}

// dd($db->getQuery());
$allSkills = $db->table('skills')->getAll();
// dd($users);
$data = [];
foreach ($users as $key => $user) {

  $skills = $db->select('skills.skill_name as s')->table('user_skills')
                ->innerJoin('skills', 'user_skills.skill_id', 'skills.id')
                ->where('user_id', $user->id)
                ->getAll();  
  $userSkills = [];

  foreach ($skills as $i => $skill) {
    $userSkills[$i] = $skill->s;
  }           
  $user->skills = implode(', ', $userSkills);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Users</title>
  <link rel="stylesheet" href="https://bootswatch.com/3/paper/bootstrap.min.css">
  <style>
    .container {
      padding-top: 12px
    }
    .filter {
        padding-top: 12px;
        padding-bottom: 14px;
    }
    #myTable_filter label {
      display: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- search form starts -->
    <div class="row">
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      </div>
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="filter">
      <form action="" method="GET" class="form-inline" role="form">
    
      <div class="form-group">
         <select class="form-control" name="filter_type" id="filter_type">
          <option value="skills" selected>skill</option>
        </select>
      </div>

      <div class="form-group">
         <select class="form-control" name="operator" id="filter_type">
          <option value="containes" <?php echo (@$_GET['operator'] == $skill->id) ? 'containes' : ''; ?>>Contains</option>
          <option value="not_contains" <?php echo (@$_GET['operator'] == $skill->id) ? 'not_contains' : ''; ?>>Doesn't Contains</option>
        </select>
      </div>

      <div class="form-group">
         <select class="form-control" name="skill" id="filter_type">
          <?php foreach($allSkills as $skill):?>
              <option value="<?php echo $skill->id; ?>" <?php echo (@$_GET['skill'] == $skill->id) ? 'selected' : ''; ?>><?php echo $skill->skill_name; ?></option>
          <?php endforeach;?>
        </select>
      </div>
    
      
    
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
    </div>
      </div>
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      </div>
    </div>
    <!-- search form ends -->
  <div class="row">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      
    </div>

    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <table class="table table-hover" id="myTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Name</th>
            <th>Skills</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user):?>
                <tr>
                  <td><?php echo $user->id; ?></td>
                  <td><?php echo $user->username; ?></td>
                  <td><?php echo $user->name; ?></td>
                  <td><?php echo $user->skills; ?></td>
                </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>

    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      
    </div>
  </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css"> 
<script src="//cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src=" //cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready( function () {
  $('#myTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});
</script>
</body>
</html>
