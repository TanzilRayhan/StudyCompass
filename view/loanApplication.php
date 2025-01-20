<!DOCTYPE html>
<html lang="en">

<head>
    <title>Apply for Loan</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetchLoans();
        });
        function fetchLoans() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '../controller/loanController.php?action=fetchLoans', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        renderLoans(response.loans);
                    } else {
                        alert("Error fetching loans: " + response.message);
                    }
                }
            };
            xhr.send();
        }
        function renderLoans(loans) {
            const loanContainer = document.getElementById('loan-list');
            loans.forEach(loan => {
                const loanHTML = `
                    <div class="loan-item">
                        <h3>${loan.name}</h3>
                        <p>Interest Rate: ${loan.interest_rate}%</p>
                        <p>Max Amount: $${loan.max_amount}</p>
                    </div>
                `;
                loanContainer.innerHTML += loanHTML;
            });
        }

        function applyForLoan() {
            const loanId = document.getElementById('loanId').value.trim();
            const amount = document.getElementById('amount').value.trim();

            if (!loanId || !amount || amount <= 0) {
                alert("Please fill in all fields with valid values.");
                return;
            }

            const data = JSON.stringify({ loanId, amount });

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/loanController.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('data=' + data);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const messageElement = document.getElementById('response-message');

                    if (response.success) {
                        messageElement.textContent = `Loan Application Successful! Loan ID: ${response.loanId}`;
                        messageElement.style.color = 'green';
                    } else {
                        messageElement.textContent = `Error: ${response.message}`;
                        messageElement.style.color = 'red';
                    }
                }
            };
        }
    </script>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="#">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Apply for a Loan</h1>

        <section id="loan-list" class="loan-list">
            <h2>Available Loans</h2>>
        </section>

        <div class="form-container">
            <form onsubmit="event.preventDefault(); applyForLoan();">
                <div class="form-group">
                    <label for="loanId">Loan Plan ID</label>
                    <input type="text" id="loanId">
                </div>
                <div class="form-group">
                    <label for="amount">Loan Amount</label>
                    <input type="number" id="amount">
                </div>
                <button type="submit">Submit</button>
            </form>
            <p id="response-message"></p>
        </div>
    </div>
</body>

</html>
