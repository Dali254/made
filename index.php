
<?php
require_once 'config.php';

// Get latest jobs
$jobs_query = "SELECT * FROM jobs ORDER BY created_at DESC LIMIT 6";
$jobs_result = $conn->query($jobs_query);

// Get latest blog posts
$blog_query = "SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT 3";
$blog_result = $conn->query($blog_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Your Gateway to Online Earning & Jobs</title>
    <meta name="description" content="Discover the best online jobs, side hustles, and money-making opportunities in Kenya. Join thousands earning online today!">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo SITE_NAME; ?>">
    <meta property="og:description" content="Your trusted platform for online jobs and earning opportunities in Kenya">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL; ?>">
    <meta property="og:image" content="<?php echo SITE_URL; ?>/assets/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Loading Animation -->
    <div class="loading">
        <div class="spinner"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">💼 Jobs Kenya</a>
            <div class="mobile-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-menu">
                <li><a href="jobs.php">Browse Jobs</a></li>
                <li><a href="post-job.php">Post Job</a></li>
                <li><a href="job-seekers.php">Job Seekers</a></li>
                <li><a href="blog.php">Blog</a></li>
                <?php if (is_logged_in()): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php" class="btn btn-gradient">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php" class="btn btn-gradient">Get Started</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Make Money Online in Kenya 🇰🇪</h1>
            <p>Your trusted platform for discovering legitimate online jobs, side hustles, and earning opportunities across Kenya. Join thousands already earning!</p>
            <div class="cta-buttons">
                <a href="register.php" class="btn btn-primary">Start Earning Today</a>
                <a href="jobs.php" class="btn btn-outline">Browse Jobs</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container">
        <div class="section-header">
            <h2>Why Choose Jobs Kenya?</h2>
            <p>The most trusted platform for online opportunities in Kenya</p>
        </div>
        
        <div class="cards-grid">
            <div class="card">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3>Verified Jobs</h3>
                <p>All job listings are verified by our team to ensure legitimacy and protect you from scams.</p>
            </div>
            
            <div class="card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3>Earn & Refer</h3>
                <p>Get your unique referral link and earn bonuses for every person you bring to the platform.</p>
            </div>
            
            <div class="card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Community Support</h3>
                <p>Join a vibrant community of earners, share tips, and grow together.</p>
            </div>
            
            <div class="card">
                <div class="stat-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>M-PESA Ready</h3>
                <p>Most opportunities support M-PESA payments for instant withdrawals.</p>
            </div>
            
            <div class="card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>Learning Resources</h3>
                <p>Access free guides, tutorials, and tips on how to succeed in online earning.</p>
            </div>
            
            <div class="card">
                <div class="stat-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>100% Free</h3>
                <p>No hidden fees. Create your account and start browsing jobs absolutely free!</p>
            </div>
        </div>
    </section>

    <!-- Latest Jobs Section -->
    <section class="container" style="background: var(--bg-light);">
        <div class="section-header">
            <h2>Latest Job Opportunities</h2>
            <p>Fresh opportunities posted daily</p>
        </div>
        
        <div class="cards-grid">
            <?php if ($jobs_result && $jobs_result->num_rows > 0): ?>
                <?php while ($job = $jobs_result->fetch_assoc()): ?>
                    <div class="card" data-location="<?php echo htmlspecialchars($job['location']); ?>">
                        <div class="card-header">
                            <div>
                                <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                            </div>
                            <span class="card-badge badge-new">New</span>
                        </div>
                        
                        <div class="card-meta">
                            <span class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo htmlspecialchars($job['location']); ?>
                            </span>
                            <?php if ($job['payment']): ?>
                                <span class="meta-item">
                                    <i class="fas fa-money-bill"></i>
                                    <?php echo htmlspecialchars($job['payment']); ?>
                                </span>
                            <?php endif; ?>
                            <span class="meta-item">
                                <i class="fas fa-clock"></i>
                                <?php echo time_ago($job['created_at']); ?>
                            </span>
                        </div>
                        
                        <p><?php echo substr(htmlspecialchars($job['description']), 0, 150); ?>...</p>
                        
                        <div class="card-footer">
                            <?php if ($job['deadline']): ?>
                                <span style="color: var(--danger-color); font-weight: 600;">
                                    <i class="fas fa-calendar"></i> Deadline: <?php echo format_date($job['deadline']); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ($job['apply_link']): ?>
                                <a href="<?php echo htmlspecialchars($job['apply_link']); ?>" target="_blank" class="btn btn-gradient" style="padding: 0.5rem 1.5rem;">
                                    Apply Now <i class="fas fa-arrow-right"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align: center; color: var(--text-light);">No jobs available at the moment. Check back soon!</p>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="jobs.php" class="btn btn-gradient">View All Jobs <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- How It Works -->
    <section class="container">
        <div class="section-header">
            <h2>How It Works</h2>
            <p>Get started in 3 simple steps</p>
        </div>
        
        <div class="cards-grid">
            <div class="card">
                <div style="font-size: 3rem; margin-bottom: 1rem;">1️⃣</div>
                <h3>Create Account</h3>
                <p>Sign up for free and get your unique referral code instantly. No payment required!</p>
            </div>
            
            <div class="card">
                <div style="font-size: 3rem; margin-bottom: 1rem;">2️⃣</div>
                <h3>Browse & Apply</h3>
                <p>Explore verified job listings, side hustles, and opportunities. Apply with one click!</p>
            </div>
            
            <div class="card">
                <div style="font-size: 3rem; margin-bottom: 1rem;">3️⃣</div>
                <h3>Earn & Grow</h3>
                <p>Start earning from jobs and referrals. Withdraw directly to your M-PESA!</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="hero" style="padding: 4rem 2rem;">
        <div class="hero-content">
            <h2>Ready to Start Your Journey?</h2>
            <p>Join thousands of Kenyans already earning online today!</p>
            <div class="cta-buttons">
                <a href="register.php" class="btn btn-primary">Create Free Account</a>
                <a href="jobs.php" class="btn btn-outline">Explore Jobs</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="logo" style="font-size: 2rem; margin-bottom: 1rem; color: white;">
                💼 Jobs Kenya
            </div>
            <p>Your trusted platform for online jobs and earning opportunities in Kenya</p>
            
            <div class="social-links">
                <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="#" target="_blank"><i class="fab fa-telegram"></i></a>
            </div>
            
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
                <p>&copy; <?php echo date('Y'); ?> Jobs Kenya. All rights reserved.</p>
                <p style="margin-top: 0.5rem;">
                    <a href="#" style="color: white; text-decoration: none; margin: 0 0.5rem;">Privacy Policy</a> | 
                    <a href="#" style="color: white; text-decoration: none; margin: 0 0.5rem;">Terms of Service</a> | 
                    <a href="#" style="color: white; text-decoration: none; margin: 0 0.5rem;">Contact Us</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>
