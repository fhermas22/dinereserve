<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rappel de Réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3b82f6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .reservation-details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .value {
            color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 14px;
        }
        .highlight {
            background-color: #fef3c7;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #f59e0b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DineReserve</h1>
        <h2>Rappel de Réservation</h2>
    </div>

    <div class="content">
        <p>Bonjour {{ $reservation->customer_name }},</p>

        <div class="highlight">
            <strong>Rappel :</strong> Votre réservation chez DineReserve est prévue demain !
        </div>

        <div class="reservation-details">
            <h3>Détails de votre réservation</h3>

            <div class="detail-row">
                <span class="label">Numéro de réservation:</span>
                <span class="value">#{{ $reservation->id }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Table:</span>
                <span class="value">{{ $reservation->table->name }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Date et heure:</span>
                <span class="value">{{ $reservation->formatted_date_time }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Nombre de personnes:</span>
                <span class="value">{{ $reservation->party_size }}</span>
            </div>

            @if($reservation->special_requests)
            <div class="detail-row">
                <span class="label">Demandes spéciales:</span>
                <span class="value">{{ $reservation->special_requests }}</span>
            </div>
            @endif
        </div>

        <p>Nous nous réjouissons de vous accueillir demain et de vous offrir une expérience culinaire mémorable.</p>

        <p>Si vous devez modifier ou annuler votre réservation, merci de nous contacter dès que possible.</p>

        <p>À bientôt,<br>L'équipe DineReserve</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} DineReserve. Tous droits réservés.</p>
        <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
    </div>
</body>
</html>
