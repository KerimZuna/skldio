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
    inv = {}

    with open(r"C:\xampp\htdocs\dio\barcode\python\print\output.txt", 'r') as file:

        line = file.readline().strip()
        value = int(line)
    kod = str(value)
    inv['kod'] = kod
    inv['my_qr'] = (open(generate_bar(kod,width=1000, height=500, dpi=1000), 'rb'), 'image/png')

    template_path = os.path.dirname(os.path.abspath(__file__))
    template_file = r'basic.odt'
    ime = str(win32print.GetDefaultPrinter())
    print(ime)
    filepath = os.path.join(template_path, template_file)
    print(filepath)

    basic = Template(source='', filepath=filepath)

    with tempfile.NamedTemporaryFile(delete=False, suffix='.odt') as tmpfile:
        output = basic.generate(o=inv).render().getvalue()
        tmpfile.write(output)  # /tmp in GNU/Linux,  %temp% in Windows
        # time.sleep(2)
        print(f'Printing: {tmpfile.name}')
        win32api.ShellExecute(0, 'print', tmpfile.name, f'/d:"{win32print.GetDefaultPrinter()}"', '.', 0)

if __name__ == "__main__":
    print_placard()