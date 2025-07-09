<!DOCTYPE html>
<html>
<head>
    <title>Train Schedule</title>
</head>
<body>
    <h1>Find Train Details</h1>
    <form action="getdest1.php" method="POST">
        <label for="source">Source:</label>
        <input type="text" id="source" name="Source" required>
        <br><br>
        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="Destination" required>
        <br><br>
        <button type="submit">Find Trains</button>
    </form>
</body>
</html>
