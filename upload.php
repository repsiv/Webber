<?php
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$upload_dir = "uploads/";
	$file_name = basename($_FILES['file']['name']);
	$file_path = $upload_dir . $file_name;

	// Überprüfen, ob die Datei bereits existiert
	if(file_exists($file_path)) {
		// Die neue HTML-Datei mit dem eingegebenen Namen erstellen
		$html_file = fopen("$name.html", "w");
		fwrite($html_file, "<html>\n<head>\n<title>$name</title>\n</head>\n<body>\n</body>\n</html>");
		fclose($html_file);

		// Den Link zur neuen HTML-Datei ausgeben
		$new_html_file = "$name.html";
		echo "<br>Link to html file: <a href='$new_html_file'>$new_html_file</a><br>";

		exit;
	}

	// Die Datei hochladen
	if(move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
		// Eine neue HTML-Datei mit dem eingegebenen Namen erstellen
		$html_file = fopen("$name.html", "w");
		fwrite($html_file, file_get_contents($file_path));
		fclose($html_file);

		// Den Link zur neuen HTML-Datei ausgeben
		$new_html_file = "$name.html";
		echo "Upload sucessful.<br>The link to your Web page: <a href='$new_html_file'>$new_html_file</a><br>";

		// Direkt zum Inhalt der neuen HTML-Datei springen, wenn der Link angeklickt wird
		echo "<script>window.location.href = '$new_html_file';</script>";
	}
	else {
		echo "Erorr by upload.Please try again.";
	}
}
?>
