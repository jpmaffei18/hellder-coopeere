import { ServeStaticModule } from '@nestjs/serve-static';
import { Module } from '@nestjs/common';
import { secret } from './auth/constants/constants';
import { UsersModule } from './users/users.module';
import { MongooseModule } from '@nestjs/mongoose';
import { AuthModule } from './auth/auth.module';
import { JwtModule } from '@nestjs/jwt';
import { join } from 'path/posix';
import { MulterModule } from '@nestjs/platform-express';
import { diskStorage } from 'multer';
import { v4 as uuidv4 } from 'uuid';
import { VideoService } from './video/video.service';
import { UsersService } from './users/users.service';
import { Video, VideoSchema } from './video/video.schema';
import { User, UserSchema } from './users/entities/user.entity';
import { RequestMethod, MiddlewareConsumer } from '@nestjs/common';
import { isAuthenticated } from './app.middleware';
import { VideoController } from './video/video.controller';

@Module({
  imports: [ 
    
    MongooseModule.forFeature([{ name: User.name, schema: UserSchema }]),
    MongooseModule.forFeature([{ name: Video.name, schema: VideoSchema }]),
    
    JwtModule.register({
      secret,
      signOptions: { expiresIn: '2h' },
    }),
    ServeStaticModule.forRoot({
      rootPath: join(__dirname, '..', 'public'),
    }),
    
    UsersModule,
    MongooseModule.forRoot('mongodb+srv://demithehomie:k5o328jznhcFaJ1X@cluster0.0gsouwa.mongodb.net/test'),
    
    MulterModule.register({
      storage: diskStorage({
        destination: './public',
        filename: (req, file, cb) => {
          const ext = file.mimetype.split('/')[1];
          cb(null, `${uuidv4()}-${Date.now()}.${ext}`);
        },
      })
    }),
    
    AuthModule
  ],
  controllers: [],
  providers: [VideoService, UsersService], 
})
export class AppModule {

  configure(consumer: MiddlewareConsumer) {
    consumer
      .apply(isAuthenticated)
      .exclude(
        { path: 'api/v1/video/:id', method: RequestMethod.GET }
      )
      .forRoutes(VideoController);
  }

}
