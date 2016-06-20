<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" > 

<head>
 <title> book </title>
 <H1> Библиотека успешного человека </H1>
</head>
<?php
{
$isbn = !empty($_GET['isbn'])? htmlspecialchars($_GET['isbn']):null;
$name = !empty($_GET['name'])? htmlspecialchars($_GET['name']):null;
$author = !empty($_GET['author'])? htmlspecialchars($_GET['author']):null;
}
?>
<body>
<form action="/prim12.php" method="GET">
    ISBN:
     <input type="text" name="isbn" value=<?=$isbn ?> >
	 Название:
     <input type="text" name="name" value=<?=$name ?> >
	 Автор:
	 <input type="text" name="author" value=<?=$author ?> >
     <input type="submit" value="поиск">
</form>

 <table  border="3px">
  <tr>
  <th> Название </th>
  <th> Автор </th>
  <th> Год выпуска </th>
  <th> Жанр </th>
  <th> ISBN </th>
  </td>
<?php
include("conf.php");
$pdo = new PDO("mysql:host=". DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$pdo->exec("SET NAMES utf8;");
$sql = "SELECT name, author, year, genre, isbn  FROM books WHERE isbn LIKE '%$isbn%' and name LIKE '%$name%' and author LIKE '%$author%'"; 
$stm = $pdo->prepare($sql);
$stm->execute();
//
/* не получается передать параметр в LIKE длязащиты от инъекций
if (!empty($_GET))
{
$sql .=" WHERE isbn LIKE '%?%' and name LIKE '%?%' and author LIKE '%?%'"; // 
$stm = $pdo->prepare($sql);
$stm->execute(array($isbn,$name,$author));
}
else
{
	$stm = $pdo->prepare($sql);
	$stm->execute();
}
//*/
$res = $stm->fetchAll();
foreach ($res as $item)
{echo "<tr>";
$i=0;
	 WHILE ($i<=4)
	 {
	  ?> 
		<td> 
		   <?php echo $item[$i];?>
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
