</div> 
    </div> 
    <script src="assets/js/main.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/users.js"></script>

    <script>
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('loading').style.display = 'flex';
            });
        });
        
        window.addEventListener('load', () => {
            document.getElementById('loading').style.display = 'none';
        });
    </script>
</body>
</html>