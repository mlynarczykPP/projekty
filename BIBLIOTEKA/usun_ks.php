<html lang="pl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title> Piotr Młynarczyk - BD2 Projekt </title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div id="strona">
		<header>
			<a href="index.html">Biblioteka</a>
		</header>
		<div id="menu">
			<nav>
				<ul>
					<li id="czytelnik"><a href="czytelnik.php">Czytelnik</a>
						<ul id="pod">
							<li><a href="dodaj_cz.php">Dodaj</a></li>
							<li><a href="usun_cz.php">Usuń</a></li>
							<li><a href="ksiazki.php">Szukaj</a></li>
						</ul>
					</li>
					<li id="ksiazka"><a href="ks.php">Książka</a>
						<ul id="pod">
							<li><a href="dodaj_ks.php">Dodaj</a></li>
							<li><a href="usun_ks.php">Usuń</a></li>
							<li><a href="dzial.php">Dział</a></li>
							<li><a href="autor.php">Autorzy</a></li>
						</ul>
					</li>
					<li><a href="wypozyczenia.php">Wypożyczenia</a></li>
					<li><a href="oddaj.php">Oddanie</a></li>
				</ul>				
			</nav>
		</div>
		<div id="artykuly">
			<article id="art">
			<?php
				include 'autoryzacja.php';
		
				$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)
				or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
		
				mysqli_query($conn,'SET NAME utf8');
			?>
				<h2> Formularz usunięcia książki: </h2>
				<form action="" method="post">
					Podaj tutył:<br> <input type="text" name="tytul"> 
					<br><br>
					Podaj nazwisko i imię autora: <input type="text" name="nazwisko">
					<br><br>
					<input type="reset" value="Wyczyść">
					<input type="submit" value="Usuń">
				</form>
	
				
			</article>
			<article id="art2">
			<h2> Książki: </h2>
				<?php
					if($_POST!=NULL)mysqli_query($conn,"DELETE FROM Ksiazka WHERE Tytul='".$_POST['tytul']."' AND Autor='".$_POST['nazwisko']."'");
			
					$result=mysqli_query($conn,"SELECT * FROM Ksiazka;");
					echo '<table align="center">';
					echo '<th>ID ksiazki</th><th>ID działu</th><th>Tytuł</th><th>Autor</th>';
					while($arr=mysqli_fetch_array($result)){
						echo '<tr>';
						echo '<td>'.$arr['id_ksiazki'].'</td><td>'.$arr['id_dzialu'].'</td><td>'.$arr['Tytul'].'</td><td>'.$arr['Autor'].'</td>';
						echo '</tr>';
					}
					echo '</table>';
				?>
				<br><br>
			</article>
		</div>
    </div>
</body>
</html>