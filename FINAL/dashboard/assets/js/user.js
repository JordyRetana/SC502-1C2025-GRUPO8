function getUsers() {
    fetch('path_to_your_api/api_get_users.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const users = data.data;
                let userList = '';
                users.forEach(user => {
                    userList += `<li>${user.first_name} ${user.last_name} - ${user.email} (${user.estado})</li>`;
                });
                document.querySelector('#userList').innerHTML = userList;
            } else {
                console.log('Error:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}

window.onload = function() {
    getUsers();
};
