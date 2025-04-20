<footer class="footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> Impulsa tu Negocio - Todos los derechos reservados.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/i18n/language.js"></script>
<?php if(isset($additionalJS)): ?>
    <?php foreach($additionalJS as $js): ?>
        <script src="<?php echo $js; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<script src="../assets/js/pages/contac.js"></script>
<script src="../assets/js/auth/auth.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../assets/js/pages/Transición.js"></script>



</body>
</html>