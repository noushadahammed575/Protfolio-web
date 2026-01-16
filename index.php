<?php
// --- PHP FORM HANDLING ---
$statusMsg = "";
$statusClass = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($message)) {
        $statusMsg = "Error: System requires all input fields.";
        $statusClass = "error";
    } else {
        // Simulate sending
        $statusMsg = "Success: Transmission received from $name.";
        $statusClass = "success";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nousad | Professional Profile</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- 1. BRIGHT & FORMAL THEME VARIABLES --- */
        :root {
            /* Backgrounds */
            --bg-body: #f4f7f6;       /* Very light grey/blue */
            --bg-sidebar: #ffffff;    /* Pure white */
            --bg-card: #ffffff;
            
            /* Colors */
            --primary: #0056b3;       /* Corporate Blue */
            --primary-light: #e7f1ff; /* Very light blue for backgrounds */
            
            /* Text */
            --text-main: #2c3e50;     /* Dark Slate */
            --text-muted: #6c757d;    /* Grey */
            
            /* Borders */
            --border: #e9ecef;
            --shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Monospace font used sparingly for "Code" feel */
        .mono-font {
            font-family: 'JetBrains Mono', monospace;
        }

        /* --- SIDEBAR LAYOUT --- */
        .sidebar {
            width: 280px;
            background: var(--bg-sidebar);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid var(--border);
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 100;
            box-shadow: var(--shadow);
        }

        .profile-header .logo { 
            font-size: 1.8rem; 
            font-weight: 800; 
            color: var(--primary); 
            letter-spacing: -0.5px;
        }
        .profile-header .role { 
            color: var(--text-muted); 
            font-size: 0.9rem; 
            margin-top: 5px; 
            font-weight: 600;
        }

        .nav-menu { margin-top: 50px; }
        .nav-menu a {
            display: block;
            padding: 12px 15px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 1rem;
            border-radius: 8px;
            transition: 0.3s;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .nav-menu a:hover, .nav-menu a.active { 
            color: var(--primary); 
            background-color: var(--primary-light); 
        }
        .nav-menu i { width: 25px; }

        .socials a { color: var(--text-muted); margin-right: 15px; font-size: 1.2rem; transition: 0.3s; }
        .socials a:hover { color: var(--primary); }

        /* --- MAIN CONTENT AREA --- */
        .main-content {
            margin-left: 280px; /* Width of sidebar */
            flex: 1;
            padding: 0 80px; /* Removed top padding to let Hero fill space */
        }

        section { padding: 80px 0; border-bottom: 1px solid var(--border); }
        section:last-child { border-bottom: none; }

        /* --- 2. HERO SECTION (Updated: Text Left, Image Right) --- */
        .hero {
            min-height: 90vh; /* Almost full screen */
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
        }

        .hero-text { flex: 1; }

        .hero h1 { 
            font-size: 3.5rem; 
            line-height: 1.2; 
            margin-bottom: 20px; 
            color: var(--text-main); 
        }
        .hero h1 .highlight { color: var(--primary); }
        
        .hero p { 
            font-size: 1.25rem; 
            color: var(--text-muted); 
            line-height: 1.6; 
            margin-bottom: 30px; 
        }

        .status-badge {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary);
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Hero Image Styling */
        .hero-image-container {
            flex: 1;
            display: flex;
            justify-content: center;
        }
        
        .hero-img {
            width: 380px;
            height: 380px;
            object-fit: cover;
            border-radius: 50%; /* Circle */
            border: 8px solid var(--bg-sidebar); /* White border */
            box-shadow: 0 20px 40px rgba(0, 50, 100, 0.15); /* Blue-ish shadow */
        }

        /* --- SKILLS --- */
        .section-title { font-size: 2rem; margin-bottom: 30px; color: var(--text-main); position: relative; }
        .section-title::after { content:''; display: block; width: 50px; height: 4px; background: var(--primary); margin-top: 10px; border-radius: 2px;}

        .cmd-box {
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }
        .cmd-header { border-bottom: 1px solid var(--border); padding-bottom: 15px; margin-bottom: 20px; color: var(--text-muted); font-size: 0.9rem; }
        .skill-list { display: flex; flex-wrap: wrap; gap: 15px; }
        
        .skill-item { 
            background: var(--primary-light);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* --- PROJECTS --- */
        .project-card {
            display: flex;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
            transition: 0.3s;
            box-shadow: var(--shadow);
        }
        .project-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        .p-img { width: 35%; object-fit: cover; }
        .p-content { padding: 40px; width: 65%; display: flex; flex-direction: column; justify-content: center; }
        .p-tech { font-size: 0.8rem; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;}
        .p-content h3 { font-size: 1.5rem; margin-bottom: 10px; color: var(--text-main); }
        .p-content p { color: var(--text-muted); font-size: 1rem; line-height: 1.6; }

        /* --- CONTACT FORM --- */
        .form-grid { display: grid; gap: 20px; max-width: 600px; }
        
        input, textarea {
            background: var(--bg-card);
            border: 1px solid #ccc;
            padding: 15px;
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            width: 100%;
            border-radius: 8px;
            font-size: 1rem;
        }
        input:focus, textarea:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 4px var(--primary-light); }
        
        button {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }
        button:hover { background: #004494; transform: translateY(-2px); }

        .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; font-weight: 500;}
        .alert.error { background: #ffe6e6; color: #d63031; border: 1px solid #fab1a0; }
        .alert.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

        /* --- MOBILE RESPONSIVE --- */
        @media (max-width: 900px) {
            body { flex-direction: column; }
            .sidebar {
                width: 100%; height: auto; position: relative;
                padding: 15px 20px; flex-direction: row; align-items: center;
                border-right: none; border-bottom: 1px solid var(--border);
            }
            .profile-header .role, .socials { display: none; }
            .nav-menu { margin-top: 0; display: flex; gap: 15px; }
            .nav-menu span { display: none; } /* Icons only on mobile */
            
            .main-content { margin-left: 0; padding: 20px; }
            
            .hero { flex-direction: column-reverse; text-align: center; min-height: auto; padding-top: 40px;}
            .hero-img { width: 250px; height: 250px; margin-bottom: 30px;}
            
            .project-card { flex-direction: column; }
            .p-img { width: 100%; height: 200px; }
            .p-content { width: 100%; padding: 25px; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="profile-header">
            <div class="logo">Nousad</div>
            <p class="role">Java • ML • DEVOPS</p>
            <nav class="nav-menu">
                <a href="#home" class="active"><i class="fas fa-home"></i> <span>Home</span></a>
                <a href="#skills"><i class="fas fa-code"></i> <span>Stack</span></a>
                <a href="#projects"><i class="fas fa-layer-group"></i> <span>Projects</span></a>
                <a href="#contact"><i class="fas fa-envelope"></i> <span>Contact</span></a>
            </nav>
        </div>

        <div class="socials">
            <a href="#"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </aside>

    <main class="main-content">
        
        <section id="home" class="hero">
            <div class="hero-text">
                <div class="status-badge"><i class="fas fa-circle" style="font-size:0.6rem; margin-right:5px;"></i> Available for work</div>
                <h1>Building secure <br><span class="highlight">digital architecture</span>.</h1>
                <p>I am Nousad. A student developer bridging the gap between robust Java backends, intelligent ML algorithms, and Devops.</p>
                <a href="#contact" style="text-decoration:none;">
                    <button>Get In Touch</button>
                </a>
            </div>
            
            <div class="hero-image-container">
                <img src="images/noush.jpg" 
                     alt="noush Profile" 
                     class="hero-img">
            </div>
        </section>

        <section id="skills">
            <h2 class="section-title">Technical Stack</h2>
            <div class="cmd-box">
                <div class="cmd-header mono-font">root@Noushad:~/skills</div>
                <div class="skill-list mono-font">
                    <div class="skill-item">Java Core & OOP</div>
                    <div class="skill-item">JavaFX GUI</div>
                    <div class="skill-item">Python (Pandas, Scikit)</div>
                    <div class="skill-item">MySQL / Database</div>
                    <div class="skill-item">Linux Admin</div>
                    <div class="skill-item">Network Security</div>
                </div>
            </div>
        </section>

        <section id="projects">
            <h2 class="section-title">Selected Works</h2>
            
            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="p-img" alt="Tour System">
                <div class="p-content">
                    <div class="p-tech mono-font">Java • JavaFX • MySQL</div>
                    <h3>Tour Management System</h3>
                    <p>A desktop solution optimizing travel logistics. Features include user session management, booking algorithms, and dynamic itinerary generation.</p>
                </div>
            </div>

          <div class="project-card">
            <img src="https://images.unsplash.com/photo-1551076805-e1869033e561?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="p-img" alt="ML Research">
                <div class="p-content">
              <div class="p-tech mono-font">Python • ML • Research</div>
                <h3>Lung Cancer Detection</h3>
             <p>Analysis of medical datasets using ensemble learning techniques. Focused on feature balancing to reduce false negatives in diagnosis.</p>
             </div>
</div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="p-img" alt="Portfolio">
                <div class="p-content">
                    <div class="p-tech mono-font">PHP • Secure Code</div>
                    <h3>Developer Portfolio</h3>
                    <p>You are looking at it. A custom-built PHP portfolio designed with a focus on clean architecture and responsive design principles.</p>
                </div>
            </div>
        </section>

        <section id="contact">
            <h2 class="section-title">Contact Me</h2>
            
            <?php if ($statusMsg): ?>
                <div class="alert <?= $statusClass ?>">
                    <?= $statusMsg ?>
                </div>
            <?php endif; ?>

            <form method="post" class="form-grid">
                <input type="text" name="name" placeholder="Your Name">
                <input type="email" name="email" placeholder="Your Email">
                <textarea name="message" rows="5" placeholder="Your Message..."></textarea>
                <button type="submit">Send Message</button>
            </form>
        </section>

        <footer>
            <p class="mono-font" style="font-size: 0.8rem; color: var(--text-muted); padding: 20px 0;">
                &copy; <?= date("Y") ?> Noushad.dev // System Version 2.0
            </p>
        </footer>

    </main>

</body>
</html>