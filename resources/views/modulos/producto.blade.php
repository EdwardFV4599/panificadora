import { useState } from 'react'
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"

export default function ProductForm() {
  const [formData, setFormData] = useState({
    productoNombre: '',
    productoPrecio: '',
    productoCantidad: '',
    productoCategoria: ''
  })

  const handleChange = (e) => {
    const { name, value } = e.target
    setFormData(prevState => ({
      ...prevState,
      [name]: value
    }))
  }

  const handleCategoryChange = (value) => {
    setFormData(prevState => ({
      ...prevState,
      productoCategoria: value
    }))
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    // Aquí deberías implementar la lógica para enviar los datos al backend de Laravel
    console.log('Datos del formulario:', formData)
    // Ejemplo de cómo podrías enviar los datos a tu API de Laravel
    // try {
    //   const response = await fetch('/api/productos', {
    //     method: 'POST',
    //     headers: {
    //       'Content-Type': 'application/json',
    //     },
    //     body: JSON.stringify(formData)
    //   })
    //   if (response.ok) {
    //     console.log('Producto creado exitosamente')
    //   } else {
    //     console.error('Error al crear el producto')
    //   }
    // } catch (error) {
    //   console.error('Error:', error)
    // }
  }

  return (
    <Card className="w-full max-w-md mx-auto">
      <CardHeader>
        <CardTitle>Crear Nuevo Producto</CardTitle>
        <CardDescription>Ingrese los detalles del nuevo producto</CardDescription>
      </CardHeader>
      <form onSubmit={handleSubmit}>
        <CardContent className="space-y-4">
          <div className="space-y-2">
            <Label htmlFor="productoNombre">Nombre del Producto</Label>
            <Input
              id="productoNombre"
              name="productoNombre"
              value={formData.productoNombre}
              onChange={handleChange}
              required
            />
          </div>
          <div className="space-y-2">
            <Label htmlFor="productoPrecio">Precio del Producto</Label>
            <Input
              id="productoPrecio"
              name="productoPrecio"
              type="number"
              step="0.01"
              value={formData.productoPrecio}
              onChange={handleChange}
              required
            />
          </div>
          <div className="space-y-2">
            <Label htmlFor="productoCantidad">Cantidad del Producto</Label>
            <Input
              id="productoCantidad"
              name="productoCantidad"
              type="number"
              value={formData.productoCantidad}
              onChange={handleChange}
              required
            />
          </div>
          <div className="space-y-2">
            <Label htmlFor="productoCategoria">Categoría del Producto</Label>
            <Select onValueChange={handleCategoryChange} value={formData.productoCategoria}>
              <SelectTrigger>
                <SelectValue placeholder="Seleccione una categoría" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="electronica">Electrónica</SelectItem>
                <SelectItem value="ropa">Ropa</SelectItem>
                <SelectItem value="hogar">Hogar</SelectItem>
                <SelectItem value="alimentos">Alimentos</SelectItem>
              </SelectContent>
            </Select>
          </div>
        </CardContent>
        <CardFooter>
          <Button type="submit" className="w-full">Crear Producto</Button>
        </CardFooter>
      </form>
    </Card>
  )
}