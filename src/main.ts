import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module';
import { ValidationPipe } from '@nestjs/common';
import { SwaggerModule } from '@nestjs/swagger';
import { DocumentBuilder } from '@nestjs/swagger/dist';

async function bootstrap() {
  
  const app = await NestFactory.create(AppModule);

  const config = new DocumentBuilder()
  // Cria a const config que receberá a execução do Método DocumentBuilder(), responsável por construir o Swagger. Dentro deste Método serão enviados alguns parâmetros.

  .setTitle('Projeto Coopere - API')
  .setDescription('API da Coopeere que será usada nos PWAs e nos Mobile Apps')
  .setContact("TripleAVB (pela Makrom Agência Digital)","http://www.github.com/tripleavb  ","venturebuildertriplea@gmail.com")
  .setVersion('1.0')
  .addBearerAuth()
  .build();
  const document = SwaggerModule.createDocument(app, config);
  SwaggerModule.setup('/swagger', app, document);

  //process.env.TZ = '-03:00';

  app.useGlobalPipes(new ValidationPipe());
  app.enableCors();
  await app.listen(process.env.PORT || 3000);
}
bootstrap();
