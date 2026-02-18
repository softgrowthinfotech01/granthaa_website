<!DOCTYPE html>
<html>
<head>
    <title>Leader Commissions</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    padding: 20px;
}

h2 {
    margin-bottom: 20px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 20px;
}

.card {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.card img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.card h3 {
    margin: 5px 0;
}

.label {
    font-weight: bold;
}

    </style>
</head>
<body>

    <h2>Leader Commission List</h2>

    <div id="commissionContainer" class="grid"></div>
<script>
    document.addEventListener("DOMContentLoaded", fetchCommissions);

async function fetchCommissions() {

    const token = localStorage.getItem("auth_token");

    try {
        const response = await fetch( url + "admin/commissions", {
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        });

        const result = await response.json();

        if (!response.ok) {
            alert(result.message || "Error fetching data");
            return;
        }

        const container = document.getElementById("commissionContainer");
        container.innerHTML = "";

        result.data.forEach(item => {

            const imageUrl = item.user.profile_image
                ? url + "storage/" + item.user.profile_image
                : "https://via.placeholder.com/80";

            const commissionDisplay = item.commission_type === "percent"
                ? item.commission_value + " %"
                : "₹ " + item.commission_value;

            container.innerHTML += `
                <div class="card">
                    <img src="${imageUrl}" alt="Profile">
                    
                    <h3>${item.user.first_name} ${item.user.last_name}</h3>
                    <p><span class="label">Email:</span> ${item.user.email}</p>
                    <p><span class="label">Contact:</span> ${item.user.contact_no}</p>
                    <p><span class="label">Location:</span> ${item.location.site_location}</p>
                    <p><span class="label">Commission:</span> ${commissionDisplay}</p>
                    <p><span class="label">Gender:</span> ${item.user.gender}</p>
                    <p><span class="label">City:</span> ${item.user.city}, ${item.user.state}</p>
                </div>
            `;
        });

    } catch (error) {
        console.error(error);
        alert("Server error occurred");
    }
}

</script>
</body>
</html>
