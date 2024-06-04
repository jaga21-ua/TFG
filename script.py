import json
import mysql.connector

# Conexión a la base de datos MySQL
conn = mysql.connector.connect(
    host='localhost',
    user='root',
    password='root',
    database='laravel'
)
cursor = conn.cursor()

# Leer datos del archivo JSON
def cargar_datos_desde_json(ruta_archivo):
    with open(ruta_archivo, 'r', encoding='utf-8') as file:  # Especifica la codificación como utf-8
        return json.load(file)

# Insertar datos en la tabla 'medicamentos'
def insertar_datos(datos):
    for resultado in datos:
        # Obtener las URLs de las fotos de tipo "materialas"
        if "fotos" in resultado:
            # Obtener las URLs de las fotos de tipo "materialas"
            fotos_materialas = [foto["url"] for foto in resultado["fotos"] if foto["tipo"] == "materialas"]
        else:
            fotos_materialas = None
        
        # Obtener el nombre de la vía de administración (asumiendo que solo hay una)
        via_administracion = resultado["viasAdministracion"][0]["nombre"] if resultado["viasAdministracion"] else None
        
        # Ejecutar la consulta de inserción en la base de datos
        cursor.execute('''
        INSERT INTO medicamentos (
            nregistro,
            nombre,
            labtitular,
            cpresc,
            estado,
            comerc,
            receta,
            conduc,
            triangulo,
            huerfano,
            biosimilar,
            viasAdministracion,
            dosis,
            photo
        ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
        ''', (
            resultado["nregistro"],
            resultado["nombre"],
            resultado["labtitular"],
            resultado["cpresc"],
            resultado["estado"]["aut"] if "estado" in resultado else None,
            resultado["comerc"],
            resultado["receta"],
            resultado["conduc"],
            resultado["triangulo"],
            resultado["huerfano"],
            resultado["biosimilar"],
            via_administracion,
            resultado["dosis"],
            json.dumps(fotos_materialas)  # Convertir la lista de URLs a JSON antes de insertarla
        ))
    conn.commit()

# Archivo JSON de ejemplo
archivo_json = "datos_totales.json"

# Cargar datos desde el archivo JSON y luego insertarlos en la base de datos
datos = cargar_datos_desde_json(archivo_json)
insertar_datos(datos)

# Cerrar la conexión
conn.close()
