import {Injectable} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable, shareReplay} from "rxjs";
import {HttpResponseApi} from "@interfaces/http.interface";

@Injectable({
  providedIn: 'root'
})
export class ProcesarEjecucionService {

  constructor(private http: HttpClient) { }

  Bloquear(periodo:any,fecha:any,year:any){
    return this.http.post<HttpResponseApi>(
      '/api/mantenimiento/bloquear-ejecucion',
      { periodo,fecha,year},
      { responseType: 'json' }
  );
  }

  ProcesarEjecucion(año:any,mes:any,tipo:any,ppr:any) {
    return this.http.post<HttpResponseApi>(
        '/api/mantenimiento/procesar-ejecucion',
        { año,mes,tipo,ppr },
        { responseType: 'json' }
    );
}
 reporteExcel(periodo:string,year:string,tipo:string){
  return this.http.get('/api/mantenimiento/reporte-ppr-invalidados', { 
    params:{
      periodo,
      year,
      tipo
  }, responseType: 'blob' });
 }
listarHistorial(datos: any) {
  return this.http
      .get<HttpResponseApi>('/api/mantenimiento/listar-historial', {
          params: {
              usuario: datos.usuario,
              nombre: datos.nombre,
              perfil: datos.perfil,
              equipo: datos.equipo,
              ppr: datos.ppr,
              fecha: datos.fecha,
              pagina: datos.pagina,
              longitud: datos.longitud,
          },
          responseType: 'json',
      })
      .pipe(shareReplay(1));
}

reporteExcelConsolidado(){
  return this.http.get('/api/mantenimiento/reporte-ppr-consolidado', { 
    params:{
     
  }, responseType: 'blob' });
 }
}
