<!-- FOOTER -->
<footer class="footer mt-5 pt-5 pb-3">
    <div class="container text-center text-white">

        <!-- LOGO / TITLE -->
        <h4 class="fw-bold mb-2">‍‍📱 SIPMAS Ciborelang</h4>

        <p class="mb-3">
            📢 Sistem Pengaduan Masyarakat <br>
            Mudah • Cepat • Transparan
        </p>

        <!-- MENU -->
        <div class="mb-3">
            <a href="index.php" class="footer-link">Home</a>
            <a href="tracking.php" class="footer-link">Tracking</a>
            <a href="admin/login.php" class="footer-link">Admin</a>
        </div>

        <!-- SOCIAL ICON -->
        <div class="mb-3 fs-5">
            🌐 📧 📱
        </div>

        <!-- COPYRIGHT -->
        <small class="opacity-75">
            © <?= date('Y'); ?> SIPMAS Desa Ciborelang <br>
            Made with 💙 by epaa 😎
        </small>

    </div>
</footer>

<style>
.footer {
    background: linear-gradient(135deg, #4e73df, #224abe);
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;

    /* efek glass */
    backdrop-filter: blur(10px);

    /* shadow atas */
    box-shadow: 0 -10px 30px rgba(0,0,0,0.2);
}

/* link */
.footer-link {
    color: white;
    margin: 0 10px;
    text-decoration: none;
    position: relative;
}

/* hover underline animasi */
.footer-link::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    background: white;
    left: 0;
    bottom: -3px;
    transition: 0.3s;
}

.footer-link:hover::after {
    width: 100%;
}

/* hover efek */
.footer-link:hover {
    color: #a0c4ff;
}
.footer {
    animation: fadeUp 1s ease;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
</style>