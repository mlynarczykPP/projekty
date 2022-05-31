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
			<article id="artt">
			<?php
				include 'autoryzacja.php';
		
				$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)
				or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
		
				mysqli_query($conn,'SET NAME utf8');
				
				if(isset($_POST['ksiazka']))
			mysqli_query($conn,"UPDATE Ksiazka SET czy_dostepna='Nie' WHERE id_ksiazki='".$_POST['ksiazka']."';");
			?>
				<h2> Formularz wypożyczenia: </h2>
				<form action="wypozyczenia.php" method="post">
					Podaj id czytelnika: <input type="text" name="czytelnik">
					<br><br>
					Podaj id książki: <input type="text" name="ksiazka"> 
					<br><br>
					Podaj datę: <input type="date" name="data">
					<br><br>
					<input type="reset" value="Wyczyść">
					<input type="submit" value="Dodaj">
				</form>
				<br>
				<h2> Wypożyczenia: </h2>
				<?php
					if($_POST!=NULL)mysqli_query($conn,"INSERT INTO Wypozycza (id_czytelnika, id_ksiazki, data_wypozyczenia) VALUES ('".$_POST['czytelnik']."','".$_POST['ksiazka']."','".$_POST['data']."')");
			
					$result=mysqli_query($conn,"SELECT * FROM Wypozycza JOIN Czytelnik ON Wypozycza.id_czytelnika=Czytelnik.id_czytelnika JOIN Ksiazka ON Wypozycza.id_ksiazki=Ksiazka.id_ksiazki;");
					echo '<table align="center">';
					echo '<th>ID</th><th>Imie</th><th>Nazwisko</th><th>ID</th><th>Tytuł</th><th>Data</th>';
					while($arr=mysqli_fetch_array($result)){
						echo '<tr>';
						echo '<td>'.$arr['id_czytelnika'].'</td><td>'.$arr['Imie'].'</td><td>'.$arr['Nazwisko'].'</td><td>'.$arr['id_ksiazki'].'</td><td>'.$arr['Tytul'].'</td><td>'.$arr['data_wypozyczenia'].'</td>';
						echo '</tr>';
					}
					echo '</table>';
				?>
				<br><br>
			</article>
			<article id="artt2">
			<h2> Czytelnicy: </h2>
				<?php
					$result=mysqli_query($conn,"SELECT * FROM Czytelnik;");
					echo '<table align="center">';
					echo '<th>ID_czytelnika</th><th>Imie</th><th>Nazwisko</th>';
					while($arr=mysqli_fetch_array($result)){
						echo '<tr>';
						echo '<td>'.$arr['id_czytelnika'].'</td><td>'.$arr['Imie'].'</td><td>'.$arr['Nazwisko'].'</td>';
						echo '</tr>';
					}
					echo '</table>';
					echo '<h2>Dostępne Książki:</h2>';
					$result=mysqli_query($conn,"SELECT * FROM Ksiazka WHERE czy_dostepna='Tak';");
					echo '<table align="center">';
					echo '<th>ID ksiazki</th><th>Tytuł</th><th>Autor</th>';
					while($arr=mysqli_fetch_array($result)){
						echo '<tr>';
						echo '<td>'.$arr['id_ksiazki'].'</td><td>'.$arr['Tytul'].'</td><td>'.$arr['Autor'].'</td>';
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