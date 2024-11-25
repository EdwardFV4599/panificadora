import sys
import json
import pandas as pd
from sklearn.linear_model import LinearRegression
from sklearn.model_selection import train_test_split

try:
    # Leer datos desde Laravel
    data = json.loads(sys.argv[1])  # Recibe un JSON desde Laravel
    
    # Convertir a DataFrame
    df = pd.DataFrame(data)
    
    # Validar si el archivo contiene datos válidos
    if len(df) == 0:
        print(json.dumps({'error': 'El archivo JSON está vacío o tiene un formato incorrecto'}))
        sys.exit(1)
    
    # Validar que las columnas requeridas existan
    required_columns = ['año', 'mes', 'cantidad_vendida']
    for col in required_columns:
        if col not in df.columns:
            print(json.dumps({'error': f'Falta la columna {col}'}))
            sys.exit(1)
    
    # Asegurarse de que los datos son numéricos
    df['año'] = pd.to_numeric(df['año'])
    df['mes'] = pd.to_numeric(df['mes'])
    df['cantidad_vendida'] = pd.to_numeric(df['cantidad_vendida'])
    
    # Variables independientes (año, mes) y dependiente (cantidad_vendida)
    X = df[['año', 'mes']]
    y = df['cantidad_vendida']
    
    # Validar si hay suficientes datos para el entrenamiento
    if len(df) < 2:
        print(json.dumps({'error': 'Se necesitan al menos 2 filas de datos para entrenar el modelo'}))
        sys.exit(1)
    
    # Dividir datos en entrenamiento y prueba
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
    
    # Crear y entrenar el modelo
    model = LinearRegression()
    model.fit(X_train, y_train)
    
    # Predecir para el próximo mes (ejemplo: diciembre de 2024)
    next_month = [[2024, 12]]  # Cambia el año y mes según sea necesario
    predicted_sales = model.predict(next_month)
    
    # Devolver predicción como JSON
    print(json.dumps({'prediccion': predicted_sales[0]}))

except Exception as e:
    print(json.dumps({'error': str(e)}))
    sys.exit(1)
