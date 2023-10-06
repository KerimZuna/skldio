import os
from relatorio.templates.opendocument import Template
import tempfile
import time
import win32api  # not included in requirements.txt
import win32print
from barcode.codex import Code128
from barcode.writer import ImageWriter
import PIL.Image
from PIL.PngImagePlugin import PngImageFile, PngInfo
import mysql.connector



# Replace these values with your own database configuration
host = "localhost"
user = "root"
password = ""
database = "dio"

# Create a connection to the MySQL database
connection = mysql.connector.connect(
    host=host,
    user=user,
    password=password,
    database=database
)
cursor = connection.cursor()


def generate_bar(bar_input: str, width=400, height=200, dpi=300):
    bar_name = ''
    with tempfile.NamedTemporaryFile(delete=False, suffix='.png') as tmpfile:
        # Generate the barcode
        code = Code128(bar_input, writer=ImageWriter(),)
        code.default_writer_options['module_width'] = 0.2  # Adjust the width of the bars
        code.default_writer_options['module_height'] = 10  # Adjust the height of the bars
        code.default_writer_options['dpi'] = dpi  # Set the DPI for higher quality

        code.write(tmpfile, options={"write_text": False})

        # Open the image, convert it to RGB mode, and make it wider
        img = PIL.Image.open(tmpfile)
        img = img.convert('RGB')
        img = img.resize((width, height))

        # Save the modified image
        img.save(tmpfile.name, dpi=(dpi, dpi))

        bar_name = tmpfile.name

    return bar_name

def print_placard():
    cursor.execute("SELECT * FROM regali")

    result = cursor.fetchall()
    for row in result:
        if row:

            skladiste = str(row[1])  # Replace with the appropriate index for column1
            regal_red = str(row[2])  # Replace with the appropriate index for column2
            regal_kolona = str(row[3])  # Replace with the appropriate index for column3
            regal_polje = str(row[4])
            regal_polje_kolona = str(row[5])
            # kod = "".join([skladiste, regal_red, regal_kolona, regal_polje,regal_polje_kolona])
            kod = str(row[0])
            tekst = "-".join([skladiste, regal_red, regal_kolona, regal_polje])
            tekst = "/".join([tekst,regal_polje_kolona])

            inv = {}
            inv['kod'] = tekst
            inv['my_qr'] = (open(generate_bar(kod, width=1000, height=500, dpi=1000), 'rb'), 'image/png')

            template_path = os.path.dirname(os.path.abspath(__file__))
            template_file = r'basicRegal.odt'
            ime = str(win32print.GetDefaultPrinter())
            print(ime)
            filepath = os.path.join(template_path, template_file)
            print(filepath)

            basic = Template(source='', filepath=filepath)

            with tempfile.NamedTemporaryFile(delete=False, suffix='.odt') as tmpfile:
                output = basic.generate(o=inv).render().getvalue()
                tmpfile.write(output)  # /tmp in GNU/Linux,  %temp% in Window
                print(f'Printing: {tmpfile.name}')
                win32api.ShellExecute(0, 'print', tmpfile.name, f'/d:"192.168.0.195"', '.', 0)
                time.sleep(2)
        else:
            print("No matching row found")


if __name__ == "__main__":
    print_placard()
