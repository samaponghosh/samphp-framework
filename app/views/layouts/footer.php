    </div> <!-- End of app-container -->

    <!-- Core JS -->
    <script src="<?php echo BASE_URL; ?>/assets/js/main.js"></script>
    
    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
    
    <!-- Dynamic Page Scripts -->
    <?php if(isset($page_js)): ?>
        <script src="/assets/js/<?php echo $page_js; ?>.js"></script>
    <?php endif; ?>
</body>
</html>
