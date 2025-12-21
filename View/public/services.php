<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="../assets/css/services.css">
</head>

<body>
    <?php
        include '../../includes/servicenav.php';
    ?>

    <main>
        <div class="book-header">
            <h2>Our Services</h2>
        </div>

        <div class="slider-wrapper">
            <section>
                <article>
                    <h3>Electrician</h3>
                    <p>Electrical repairs and installations.</p>
                    <ul>
                        <li>Installation Services</li>
                        <li>Repair and Fixing</li>
                        <li>wiring and Rewiring</li>
                        <li>Electrical Troubleshooting</li>
                        <li>Electrical Maintenance</li>
                    </ul>
                    <a href="electrician.php">Book Now</a>
                </article>

                <article>
                    <h3>Plumber</h3>
                    <p>Complete plumbing solutions.</p>
                    <ul>
                        <li>Leak Repairs</li>
                        <li>Pipe Installation</li>
                        <li>Drain Cleaning</li>
                    </ul>
                    <a href="#">Book Now</a>
                </article>

                <article>
                    <h3>Painter</h3>
                    <p>Interior and exterior painting services.</p>
                    <ul>
                        <li>Interior Painting</li>
                        <li>Exterior Painting</li>
                        <li>Wallpaper Installation</li>
                    </ul>
                    <a href="#">Book Now</a>
                </article>

                <article>
                    <h3>Cleaner</h3>
                    <p>Professional home cleaning services.</p>
                    <ul>
                        <li>Deep Cleaning</li>
                        <li>Regular Maintenance</li>
                        <li>Sanitization</li>
                    </ul>
                    <a href="#">Book Now</a>
                </article>

                <article>
                    <h3>Computer Technician</h3>
                    <p>Computer repair and maintenance services.</p>
                    <ul>
                        <li>Hardware Repair</li>
                        <li>Software Installation</li>
                        <li>Virus Removal</li>
                    </ul>
                    <a href="#">Book Now</a>
                </article>
            </section>

            <!-- Slider Buttons -->
            <div class="slider-buttons">
                <button id="prev">&#10094;</button>
                <button id="next">&#10095;</button>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Gharmarmat. All rights reserved.</p>
    </footer>

    <!-- Minimal JS for slider buttons -->
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