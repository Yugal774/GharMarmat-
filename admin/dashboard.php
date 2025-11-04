<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <title>dashboard</title>
</head>

<body>

    <aside class="sidebar">
        <div class="header">
            <h3>Admin</h3>
        </div>
        <ul>
            <li><i class="fa-solid fa-house"></i> Dashboard</li>
            <li><i class="fa-solid fa-user"></i> Customers</li>
            <li><i class="fa-solid fa-screwdriver-wrench"></i> Service Providers</li>
            <li><i class="fa-solid fa-calendar-days"></i> Bookings</li>
            <li><i class="fa-solid fa-envelope"></i> Messages</li>
            <li><i class="fa-solid fa-gear"></i> Settings</li>
            <li id="log-out"><i class="fa-solid fa-right-from-bracket"></i> Log Out</li>
        </ul>
    </aside>

    <div class="dashboard">
        <div class="top-bar">
            <div class="search-bar">
                <input type="search" placeholder="search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="top-right">
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-circle-user"></i>
            </div>
        </div>

        <div class="content">
            <div class="customers" id="cont-box">
                <div class="data">
                    <span>1000</span>
                    <p>Customers</p>
                </div>
                <div class="icon"><i class="fa-solid fa-users"></i></div>
            </div>
            <div class="ser-provider" id="cont-box">
                <div class="data">
                    <span>100</span>
                    <p>Service Providers</p>
                </div>
                <div class="icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
            </div>
            <div class="bookings" id="cont-box">
                <div class="data">
                    <span>100</span>
                    <p>Bookings</p>
                </div>
                <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
            </div>
            <div class="income" id="cont-box">
                <div class="data">
                    <span>$1000</span>
                    <p>Total income</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>
        </div>

        <div class="dash-data">
            <div class="recent-book">
                <div class="top">
                    <h3>Recent Bookings</h3>
                    <button>View All</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>booking date</th>
                            <th>service</th>
                            <th>ammount</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Yugal</td>
                            <td>20025/7/15</td>
                            <td>plumber</td>
                            <td>$1000</td>
                            <td>pending</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Yugal</td>
                            <td>20025/7/15</td>
                            <td>plumber</td>
                            <td>$1000</td>
                            <td>pending</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Yugal</td>
                            <td>20025/7/15</td>
                            <td>plumber</td>
                            <td>$1000</td>
                            <td>pending</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Yugal</td>
                            <td>20025/7/15</td>
                            <td>plumber</td>
                            <td>$1000</td>
                            <td>pending</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Yugal</td>
                            <td>20025/7/15</td>
                            <td>plumber</td>
                            <td>$1000</td>
                            <td>pending</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Yugal</td>
                            <td>20025/7/15</td>
                            <td>plumber</td>
                            <td>$1000</td>
                            <td>pending</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Yugal rai</td>
                            <td>20025/7/15</td>
                            <td>plumber</td>
                            <td>$1000</td>
                            <td>pending</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div </body>

</html>