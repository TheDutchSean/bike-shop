<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Inventory'; ?>
<?php 

  $bicycle_input = [
    'brand' =>  'Gazelle',
    'model' =>  'E-Bike',
    'year'  =>  2023,
    'set_catergory' => 5,
    'color' =>  'Gray',
    'description' => 'Latest E-Bike from the Gazelle Brand.',
    'set_gender' => 1,
    'set_weight' => 12.5,
    'set_price' => "$1399,95",
    'set_condition' => 4,
  ];
  
  $bicycle = NEW Bicycle($bicycle_input);

  // $object_vars = get_object_vars($bicycle);
  // echo "<pre>";
  //     print_r($object_vars);
  // echo "</pre>";
  
  // echo $bicycle -> get_price()."<br/>";
  // echo $bicycle -> get_weight_lbs()."<br/>";
  // echo $bicycle -> get_condition()."<br/>";

  // echo "<hr />";

  // $unicycle = NEW Unicycle($bicycle_input);

  // $object_vars = get_object_vars($unicycle);
  // echo "<pre>";
  //     print_r($object_vars);
  // echo "</pre>";


  // echo $unicycle -> get_price()."<br/>";
  // echo $unicycle -> get_weight_lbs()."<br/>";
  // echo $unicycle -> get_condition()."<br/>";

  // echo $unicycle -> slogan()."<br/>";
?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('/images/AdobeStock_55807979_thumb.jpeg') ?>" />
      <h2>Our Inventory of Used Bicycles</h2>
      <p>Choose the bike you love.</p>
      <p>We will deliver it to your door and let you try it before you buy it.</p>
    </div>

    <table id="inventory">
      <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Category</th>
        <th>Gender</th>
        <th>Color</th>
        <th>Weight</th>
        <th>Condition</th>
        <th>Price</th>
      </tr>

      <?php 

        $data = [];
        // $file = fopen(PRIVATE_PATH."/used_bicycles.csv", 'r');
 
        // $getHeader = false;
        // $header = false;
        // // $header = [
        // //   'brand' =>  'Gazelle',
        // //   'model' =>  'E-Bike',
        // //   'year'  =>  2023,
        // //   'category' => 5,
        // //   'color' =>  'Gray',
        // //   // 'description' => 'Latest E-Bike from the Gazelle Brand.',
        // //   'gender' => 1,
        // //   'weight_kg' => 12.5,
        // //   'price' => "$1399,95",
        // //   'condition_id' => 4,
        // // ];

        // while(!feof($file)){
        //   $row =  fgetcsv($file, 0, ',');
        //   if($row == [NULL] || $row === false){continue;}
        //     if(!$header){
        //       foreach($row as $value){
        //         $header[$value] = array_search($value, $row);
        //       }
        //     }
        //     else{           

        //       $args = [
        //         'brand' =>  $row[$header['brand']],
        //         'model' =>  $row[$header['model']],
        //         'year'  =>  $row[$header['year']],
        //         'category' => $row[$header['category']],
        //         'color' =>  $row[$header['color']],
        //         // 'description' => $row[$header['description']],
        //         'gender' => $row[$header['gender']],
        //         'set_weight' => $row[$header['weight_kg']],
        //         'set_price' => $row[$header['price']],
        //         'set_condition' => $row[$header['condition_id']],
        //       ];
            
        //       $data[] = NEW Bicycle($args);
        //     }
        // }

        // fclose($file);
        $data = ParseCSV::parse(PRIVATE_PATH."/used_bicycles.csv");  

        foreach($data as $arg){
          $bicycle = NEW Bicycle($arg)
      ?>
      <tr>
          <td><?php echo h($bicycle->brand);?></td>
          <td><?php echo h($bicycle->model);?></td>
          <td><?php echo h($bicycle->year);?></td>
          <td><?php echo h($bicycle->category);?></td>
          <td><?php echo h($bicycle->gender);?></td>
          <td><?php echo h($bicycle->color);?></td>
          <td><?php echo h($bicycle->get_weight()) . " / " . h($bicycle->get_weight_lbs());?></td>
          <td><?php echo h($bicycle->get_condition());?></td>
          <td><?php echo h($bicycle->get_price());?></td>
        </tr>
      <?php } ?>
    </table>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
