@csrf
        
        <label for="">Titulo</label>
        <input type="text" name="title" value="{{ old("title", $category->title) }}">
        
        <label for="">Url</label>
        <input type="text" name="slug" value="{{ old("title", $category->slug) }}">
        
        <button type="submit">Enviar</button>