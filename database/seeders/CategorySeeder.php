<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            // Ligas
            ['slug' => 'laliga', 'nombre' => 'La Liga', 'descripcion' => 'Camisetas oficiales de La Liga EA Sports para la temporada 25/26.', 'grupo' => 'Ligas'],
            ['slug' => 'laligahypermotion', 'nombre' => 'La Liga Hypermotion', 'descripcion' => 'Equipaciones de la Segunda División española.', 'grupo' => 'Ligas'],
            ['slug' => 'seriea', 'nombre' => 'Serie A', 'descripcion' => 'Lo mejor del fútbol italiano: Juventus, Milan, Inter y más.', 'grupo' => 'Ligas'],
            ['slug' => 'premierleague', 'nombre' => 'Premier League', 'descripcion' => 'Las camisetas de la liga más competitiva del mundo.', 'grupo' => 'Ligas'],
            ['slug' => 'league1', 'nombre' => 'League 1', 'descripcion' => 'Camisetas de la liga francesa.', 'grupo' => 'Ligas'],
            ['slug' => 'bundesliga', 'nombre' => 'Bundesliga', 'descripcion' => 'Equipaciones de los gigantes alemanes.', 'grupo' => 'Ligas'],
            ['slug' => 'ligaargentina', 'nombre' => 'Liga Argentina', 'descripcion' => 'Pasión albiceleste: Boca, River y todos los clubes.', 'grupo' => 'Ligas'],
            ['slug' => 'mas1', 'nombre' => 'Otras Ligas', 'descripcion' => 'Explora equipaciones de otras ligas del mundo.', 'grupo' => 'Ligas'],

            // Selecciones
            ['slug' => 'espana', 'nombre' => 'Selección Española', 'descripcion' => 'La Roja: camisetas oficiales y de entrenamiento.', 'grupo' => 'Selecciones'],
            ['slug' => 'argentina', 'nombre' => 'Selección Argentina', 'descripcion' => 'La albiceleste de los campeones del mundo.', 'grupo' => 'Selecciones'],
            ['slug' => 'brasil', 'nombre' => 'Selección de Brasil', 'descripcion' => 'El Jogo Bonito en tu piel.', 'grupo' => 'Selecciones'],
            ['slug' => 'francia', 'nombre' => 'Selección de Francia', 'descripcion' => 'Equipaciones de Les Bleus.', 'grupo' => 'Selecciones'],
            ['slug' => 'alemania', 'nombre' => 'Selección de Alemania', 'descripcion' => 'La maquinaria alemana: Die Mannschaft.', 'grupo' => 'Selecciones'],
            ['slug' => 'italia', 'nombre' => 'Selección de Italia', 'descripcion' => 'Gli Azzurri: elegancia y fútbol.', 'grupo' => 'Selecciones'],
            ['slug' => 'inglaterra', 'nombre' => 'Selección de Inglaterra', 'descripcion' => 'The Three Lions: camisetas históricas y nuevas.', 'grupo' => 'Selecciones'],
            ['slug' => 'portugal', 'nombre' => 'Selección de Portugal', 'descripcion' => 'Equipaciones de la selección lusa.', 'grupo' => 'Selecciones'],
            ['slug' => 'mas2', 'nombre' => 'Otras Selecciones', 'descripcion' => 'Camisetas de selecciones de todo el planeta.', 'grupo' => 'Selecciones'],

            // Retro y Especiales
            ['slug' => 'anos90', 'nombre' => 'Años 90', 'descripcion' => 'Vuelve a la época dorada con diseños icónicos.', 'grupo' => 'Retro'],
            ['slug' => 'anos2000', 'nombre' => 'Años 2000', 'descripcion' => 'Las camisetas que marcaron el cambio de milenio.', 'grupo' => 'Retro'],
            ['slug' => 'clasicas', 'nombre' => 'Clásicas Históricas', 'descripcion' => 'Leyendas del fútbol en formato textil.', 'grupo' => 'Retro'],

            // Otros productos
            ['slug' => 'tallanino', 'nombre' => 'Talla Niño', 'descripcion' => 'Equipaciones completas para los más pequeños.', 'grupo' => 'Otros'],
            ['slug' => 'cortos', 'nombre' => 'Pantalones Cortos', 'descripcion' => 'Completa tu kit con los shorts oficiales.', 'grupo' => 'Otros'],
            ['slug' => 'largos', 'nombre' => 'Pantalones Largos', 'descripcion' => 'Pantalones de entrenamiento y chándal.', 'grupo' => 'Otros'],
            ['slug' => 'botas', 'nombre' => 'Botas de Fútbol', 'descripcion' => 'El mejor calzado para brillar en el campo.', 'grupo' => 'Otros'],
            ['slug' => 'clubes', 'nombre' => 'Bufandas de Clubes', 'descripcion' => 'Siente los colores con nuestras bufandas.', 'grupo' => 'Otros'],
            ['slug' => 'selecciones_bufandas', 'nombre' => 'Bufandas de Selecciones', 'descripcion' => 'Apoya a tu país.', 'grupo' => 'Otros'],
            ['slug' => 'retro_bufandas', 'nombre' => 'Bufandas Retro', 'descripcion' => 'Diseños clásicos que nunca mueren.', 'grupo' => 'Otros'],
        ];

        foreach ($categorias as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
