<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ValueSERP Search</title>
    <link rel="stylesheet" href="style.css">
    <style>
        input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
}
    </style>
</head>
<body>
    <h1>ValueSERP Search</h1>
    
    <form action="search.php" method="post">
        <label for="queries">Enter search queries:</label>
        <input type="text" name="queries" id="queries" value="pizza" placeholder="Please Enter Pizza" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>
