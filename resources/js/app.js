import './bootstrap';
import Alpine from 'alpinejs'
import Intersect from '@alpinejs/intersect'
 
Alpine.plugin(Intersect)
Alpine.start()
 
// If you want Alpine's instance to be available everywhere.
window.Alpine = Alpine