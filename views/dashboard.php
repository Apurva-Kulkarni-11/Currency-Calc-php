<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Calc</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .result-row {
            margin-top: 20px;
        }
        .result-col {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Currency Calc</h1>
        <form action="../public/index.php?action=convert" method="post" class="mt-4">
            <div class="form-group">
                <label for="fromCurrency">From:</label>
                <select class="form-control" id="fromCurrency" name="fromCurrency">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="AUD">AUD</option>
                    <option value="JPY">JPY</option>
                    <!-- may add more currencies as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Convert</button>
        </form>

        <?php if (isset($_GET['results'])): ?>
            <?php $results = json_decode($_GET['results'], true); ?>
            <div class="result-row row">
                <?php foreach ($results as $currency => $value): ?>
                    <div class="result-col col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($currency) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($value) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
