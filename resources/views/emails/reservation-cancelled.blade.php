<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annulation de Réservation</title>
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
            background-color: #ef4444;
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
            border-left: 4px solid #ef4444;
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
        .status-badge {
            background-color: #ef4444;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DineReserve</h1>
        <h2>Annulation de Réservation</h2>
    </div>

    <div class="content">
        <p>Bonjour {{ $reservation->customer_name }},</p>

        <p>Nous vous informons que votre réservation chez DineReserve a été annulée.</p>

        <div class="reservation-details">
            <h3>Détails de la réservation annulée</h3>

            <div class="detail-row">
                <span class="label">Numéro de réservation:</span>
                <span class="value">#{{ $reservation->id }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Statut:</span>
                <span class="status-badge">Annulée</span>
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

            @if($reservation->cancellation_reason)
            <div class="detail-row">
                <span class="label">Raison d'annulation:</span>
                <span class="value">{{ $reservation->cancellation_reason }}</span>
            </div>
            @endif
        </div>

        <p>Nous sommes désolés pour ce désagrément. N'hésitez pas à faire une nouvelle réservation quand vous le souhaitez.</p>

        <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>

        <p>Cordialement,<br>L'équipe DineReserve</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} DineReserve. Tous droits réservés.</p>
        <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
    </div>
</body>
</html>
