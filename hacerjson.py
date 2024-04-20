import requests
import json

def obtener_datos_pagina(numero_pagina):
    url = f"https://cima.aemps.es/cima/rest/medicamentos?nombre&pagina={numero_pagina}"
    response = requests.get(url)
    if response.status_code == 200:
        return response.json()
    else:
        print(f"Error al obtener los datos de la página {numero_pagina}: {response.status_code}")
        return None

def main():
    numero_paginas = 989
    datos_totales = []

    for pagina in range(1, numero_paginas + 1):
        datos_pagina = obtener_datos_pagina(pagina)
        if datos_pagina:
            datos_totales.extend(datos_pagina.get("resultados", []))

    with open("datos_totales.json", 'w') as archivo:
        json.dump(datos_totales, archivo, indent=4)

    print("Datos totales exportados correctamente a datos_totales.json")

if __name__ == "__main__":
    main()
