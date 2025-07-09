<?php
// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'train_details', 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->query(("CREATE TABLE IF NOT EXISTS TRAININFO (
    TrainID INT PRIMARY KEY,
    TrainName VARCHAR(255),
    Source VARCHAR(255),
    Destination VARCHAR(255),
    DepartureTime TIME,
    ArrivalTime TIME
)")) ;



// Check if the table is empty
$result = $conn->query("SELECT COUNT(*) AS total FROM TrainInfo");
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    // Populate the table if empty
    $sql = "INSERT INTO TrainInfo (TrainID, TrainName, Source, Destination, DepartureTime, ArrivalTime) VALUES
        (111, 'CityHopper', 'Washington', 'Philadelphia', '13:00:00', '16:30:00'),
        (112, 'ValleyExpress', 'San Francisco', 'Los Angeles', '14:00:00', '18:15:00'),
        (113, 'SunshineSpecial', 'Orlando', 'Miami', '15:00:00', '19:15:00'),
        (114, 'PeakPerformer', 'Aspen', 'Denver', '10:00:00', '13:30:00'),
        (115, 'AtlanticLine', 'Philadelphia', 'Boston', '11:30:00', '15:35:00'),
        (116, 'DesertFlyer', 'Tucson', 'Phoenix', '06:30:00', '08:00:00'),
        (117, 'SouthernBelle', 'Charlotte', 'Atlanta', '13:30:00', '16:45:00'),
        (118, 'RainCitySpecial', 'Portland', 'Seattle', '10:30:00', '13:00:00'),
        (119, 'LoneStar', 'Austin', 'Dallas', '07:45:00', '11:00:00'),
        (120, 'LakeshoreExpress', 'Minneapolis', 'Chicago', '09:00:00', '13:30:00'),
        (121, 'EmpireState', 'Philadelphia', 'New York', '12:00:00', '15:05:00'),
        (122, 'GoldenGate', 'Los Angeles', 'San Diego', '15:30:00', '18:00:00'),
        (123, 'OrangeBlossom', 'Orlando', 'Tampa', '08:00:00', '09:45:00'),
        (124, 'RockyRanger', 'Denver', 'Salt Lake City', '18:00:00', '22:30:00'),
        (125, 'SeaboardExpress', 'Boston', 'New York', '16:45:00', '20:50:00')";

    if ($conn->query($sql) === TRUE) {
        echo "Train details have been populated successfully.<br><br>";
    } else {
        echo "Error populating train details: " . $conn->error;
        exit;
    }
}

// Function to find routes
function findRoutes($conn, $source, $destination, $path = [], $visited = []) {
    // Avoid revisiting stations
    if (in_array($source, $visited)) {
        return [];
    }

    // Mark the station as visited
    $visited[] = $source;

    // Fetch all trains departing from the current source
    $sql = "SELECT * FROM TrainInfo WHERE Source = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $source);
    $stmt->execute();
    $result = $stmt->get_result();

    $routes = [];
    while ($row = $result->fetch_assoc()) {
        $newPath = $path;
        $newPath[] = $row;

        // If the train directly reaches the destination
        if ($row['Destination'] === $destination) {
            $routes[] = $newPath;
        } else {
            // Recursively search for connecting trains
            $nextRoutes = findRoutes($conn, $row['Destination'], $destination, $newPath, $visited);
            $routes = array_merge($routes, $nextRoutes);
        }
    }

    return $routes;
}

// Fetch user inputs
$source = $_POST['Source'] ?? null;
$destination = $_POST['Destination'] ?? null;

if ($source && $destination) {
    // Find all possible routes
    $routes = findRoutes($conn, $source, $destination);
    if (count($routes) > 0) {
        echo "<h2>Available Routes</h2>";
        foreach ($routes as $route) {
            echo "<table border='1'>
                    <tr>
                        <th>Train ID</th>
                        <th>Train Name</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                    </tr>";
            foreach ($route as $train) {
                echo "<tr>
                        <td>{$train['TrainID']}</td>
                        <td>{$train['TrainName']}</td>
                        <td>{$train['Source']}</td>
                        <td>{$train['Destination']}</td>
                        <td>{$train['DepartureTime']}</td>
                        <td>{$train['ArrivalTime']}</td>
                      </tr>";
            }
            echo "</table><br>";
        }
    } else {
        echo "No routes available for the selected journey.";
    }
} else {
    echo "Please provide both source and destination.";
}

$conn->close();
?>
