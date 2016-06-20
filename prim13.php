<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" > 

<head>
 <title> tasks </title>
 <H1> Список дел на сегодня </H1>
</head>
<?php
{
$vdescription = !empty($_GET['vdescription'])? $_GET['vdescription']:null;
$id = !empty($_GET['id'])? $_GET['id']:null;

}
?>
<body>

 <table  border="3px">
  <tr>
  <th> Описание задачи </th>
  <th> Дата добавления </th>
  <th> Статус </th>
  <th> Действия </th>
  </td>
<?php
include("confTasks.php");
$pdo = new PDO("mysql:host=". DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$pdo->exec("SET NAMES utf8;");
//***************
//var_dump($_GET);
//*
if (!empty($_GET['action']) and $_GET['action']=="edit" ) //выбрать для изменения
{
$sql = "SELECT description FROM tasks WHERE id='$_GET[id]'"; 
$stm = $pdo->prepare($sql);
$stm->execute();
$res = $stm->fetchAll();
$vdescription=$res[0]['description'];
}
//*/	
if (!empty($vdescription) and empty($_GET['id'])) //добавить 
{	
$vdate_added = date("Y-m-d H:i:s");
$sql = "INSERT INTO tasks(description, date_added, is_done)
		VALUES (?,'$vdate_added',0)";	
$stm = $pdo->prepare($sql);
$stm->execute(array($vdescription)); //
}
//********************
if (!empty($_GET['action']) and $_GET['action']=='done') // выполнить 
{	
var_dump($vdescription);
$sql = "UPDATE tasks SET is_done='1' WHERE id='$_GET[id]'";
$stm = $pdo->prepare($sql);
$stm->execute();
$id = null;
}
//*************************
if (!empty($_GET['action']) and $_GET['action']=='delete') // удалить 
{	
var_dump($vdescription);
$sql = "DELETE FROM tasks WHERE id='$_GET[id]' LIMIT 1";
$stm = $pdo->prepare($sql);
$stm->execute();
$id = null;
}
//********************
if (!empty($vdescription) and !empty($_GET['id'])) // изменить 
{	

$sql = "UPDATE tasks SET description='$vdescription' WHERE id='$_GET[id]'";
$stm = $pdo->prepare($sql);
$stm->execute();

	if ($_GET['action']=='null')
	{
		$id = null;
		$vdescription = null;
	}
}


?>

<form action="/prim13.php" method="GET">
    Описание задачи:
     <input type="text" name="vdescription" value="<?=$vdescription?>">
	 <input type="hidden" name="id" value= <?=$id?> >
	 <input type="hidden" name="action" value= 'null' >
     <input type="submit" value="сохранить">
		 
</form>

<?php
// 
$sql = "SELECT id, description, date_added, IF(is_done=0,'В процессе','Выполнено') FROM tasks"; 
$stm = $pdo->prepare($sql);
$stm->execute();
$res = $stm->fetchAll();

foreach ($res as $item)
{echo "<tr>";
$i=1;
	 WHILE ($i<=4)
	 {
	  ?> 
		<td> 
			<?php 
			
			if ($i<4)
			{			
				echo $item[$i]; 
				
			}
			else 
			{
				?>
				<a href='?id=<?="$item[id]"?>&action=edit'>Изменить</a> 
				<a href='?id=<?="$item[id]"?>&action=done'>Выполнить</a> 
				<a href='?id=<?="$item[id]"?>&action=delete'>Удалить</a> 
				<?php ;
			}
		?>
		</td>
	  <?php
	  $i++;
	 }
  echo "</tr>";   
	
}

?>
</table>
</body>
</html>
