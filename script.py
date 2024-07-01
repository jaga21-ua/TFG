import json
import mysql.connector

conn = mysql.connector.connect(
    host='localhost',
    user='root',
    password='root',
    database='laravel'
)
cursor = conn.cursor()

def cargar_datos_desde_json(ruta_archivo):
    with open(ruta_archivo, 'r', encoding='utf-8') as file: 
        return json.load(file)


def insertar_datos(datos):
    for resultado in datos:
        if "fotos" in resultado:
            fotos_materialas = [foto["url"] for foto in resultado["fotos"] if foto["tipo"] == "materialas"]
        else:
            fotos_materialas = None
        via_administracion = resultado["viasAdministracion"][0]["nombre"] if resultado["viasAdministracion"] else None
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
            json.dumps(fotos_materialas) 
        ))
    conn.commit()


archivo_json = "datos_totales.json"

datos = cargar_datos_desde_json(archivo_json)
insertar_datos(datos)

conn.close()
