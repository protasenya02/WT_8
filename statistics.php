<?php



require_once("constants.php");

function connectBD($query)
{
    // подключение к базе данных
    $mysqli = @new mysqli(HOST, USER, PASS, DB);
    // проверка соединения
    if ($mysqli->connect_errno) {
        printf("Connection failed: %s\n", $mysqli->connect_error);
        exit();
    }
    // установка кодировки
    $mysqli->set_charset('utf8');

    // запрос к БД
    $result = $mysqli->query($query);

    // закрытие соединения
    $mysqli->close();

    // возврат объекта mysqli_result.
    return $result;
}

function outputBrowserTable()
{

    if (isset($_POST['show'])) {

        // текст запроса к БД
        $query = "SELECT * FROM `browsers` ORDER BY `view_counter` DESC";

        $result = connectBD($query);

        if ($result->num_rows > 0) {

            echo "<table class='browser_table'><tr><th>id</th><th>Name</th><th>View counter</th></tr>";

            // вывод каждой строки из таблицы
            while ($row = $result->fetch_assoc()) {

                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["view_counter"] . "</td></tr>";

            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
}

function getBrowser()
{
    // получение данных которые браузер отпотправляет на сервер для самоиндентификации
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser_name = 'Unknown';

    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $browser_name = 'Internet Explorer';
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $browser_name = 'Mozilla Firefox';
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $browser_name = 'Google Chrome';
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $browser_name = 'Safari';
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $browser_name = 'Opera';
    }
    elseif(preg_match('/Brave/i',$u_agent))
    {
        $browser_name = 'Brave';
    }

    return  $browser_name;
}

function updateBrowserTable()
{
    $browser_name = getBrowser();
    echo "<h2 class='browser_name'>Your browser: $browser_name</h2>";

    if ( !isset($_COOKIE['browser'])) {
        setcookie("browser", getBrowser(), time()+ 500);

        $_COOKIE['browser'] = $browser_name;
        $query = "UPDATE `browsers`
                  SET `view_counter` = `view_counter` + 1
                  WHERE `name` = '$browser_name'";

        connectBD($query);
    }
}

