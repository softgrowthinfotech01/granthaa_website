<!DOCTYPE html>
<html>

<head>
    <title>All Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #2c3e50;
            color: white;
        }

        tr:hover {
            background: #f2f2f2;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            color: white;
            font-size: 12px;
        }

        .leader {
            background: #3498db;
        }

        .admin {
            background: #e74c3c;
        }

        .adviser {
            background: #9b59b6;
        }

        .customer {
            background: #2ecc71;
        }

        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <h2>Users List</h2>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Contact</th>
                <th>City</th>
                <th>Bank</th>
            </tr>
        </thead>
        <tbody id="userTable">
            <tr>
                <td colspan="7">Loading...</td>
            </tr>
        </tbody>
    </table>

    <script>
        const token = localStorage.getItem("auth_token");

        fetch("http://127.0.0.1:8000/api/leader_list?role=leader", {
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(response => {

                const users = response.data;
                const table = document.getElementById("userTable");
                table.innerHTML = "";

                users.forEach(user => {

                    let imageUrl = user.profile_image ?
                        "http://127.0.0.1:8000/storage/" + user.profile_image :
                        "https://via.placeholder.com/50";

                    table.innerHTML += `
            <tr>
                <td><img src="${imageUrl}" /></td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>
                    <span class="badge ${user.role}">
                        ${user.role}
                    </span>
                </td>
                <td>${user.contact_no ?? '-'}</td>
                <td>${user.city ?? '-'}</td>
                <td>${user.bank_name ?? '-'}</td>
            </tr>
        `;
                });

            })
            .catch(error => {
                document.getElementById("userTable").innerHTML =
                    "<tr><td colspan='7'>Error loading data</td></tr>";
            });
    </script>

</body>

</html>