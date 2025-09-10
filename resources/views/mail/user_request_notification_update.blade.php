<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Статус заявки обновлён</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; background: #fff; padding: 20px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #28a745; }
        p { font-size: 16px; line-height: 1.5; }
        .details { background: #f1f1f1; padding: 10px; border-radius: 5px; margin-top: 10px; }
        .btn { display: inline-block; padding: 10px 20px; margin-top: 15px; background: #28a745; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Статус заявки обновлён</h2>
        <p>Заявка <strong>{{ $request->title }}</strong> изменила статус на <strong>{{ $request->status->name }}</strong>.</p>

        <div class="details">
            <p><strong>Заголовок:</strong> {{ $request->title }}</p>
            <p><strong>Описание:</strong> {{ $request->description }}</p>
            <p><strong>Оборудование:</strong> {{ $request->equipment->model ?? 'Не указано' }}</p>
        </div>

        <a href="{{ route('employee.requests.show', $request->id) }}" class="btn">Посмотреть заявку</a>
    </div>
</body>
</html>
