<?php
include '../../includes/dbconnect.php';

// Fetch all professions
$professionQuery = "SELECT profession_id, profession_name FROM profession";
$professionResult = mysqli_query($conn, $professionQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="../assets/css/services.css">
</head>

<body>

<?php include '../../includes/servicenav.php'; ?>

<main>
    <div class="book-header">
        <h2>Our Services</h2>
    </div>

    <div class="slider-wrapper">
        <section>

            <?php while ($profession = mysqli_fetch_assoc($professionResult)) { ?>
                <article>
                    <h3><?php echo htmlspecialchars($profession['profession_name']); ?></h3>

                    <ul>
                        <?php
                        $professionId = $profession['profession_id'];

                        $workQuery = "SELECT work_name FROM work WHERE profession_id = $professionId";
                        $workResult = mysqli_query($conn, $workQuery);

                        if (mysqli_num_rows($workResult) > 0) {
                            while ($work = mysqli_fetch_assoc($workResult)) {
                                echo "<li>" . htmlspecialchars($work['work_name']) . "</li>";
                            }
                        } else {
                            echo "<li>No work available</li>";
                        }
                        ?>
                    </ul>

                    <a href="book.php?profession_id=<?php echo $professionId; ?>">Book Now</a>
                </article>
            <?php } ?>

        </section>

        <div class="slider-buttons">
            <button id="prev">&#10094;</button>
            <button id="next">&#10095;</button>
        </div>
    </div>
</main>

<footer>
    <p>&copy; 2025 Gharmarmat. All rights reserved.</p>
</footer>

<script>
    const slider = document.querySelector('section');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');

    prevBtn.addEventListener('click', () => {
        slider.scrollBy({ left: -300, behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', () => {
        slider.scrollBy({ left: 300, behavior: 'smooth' });
    });
</script>

</body>
</html>
