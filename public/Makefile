.PHONY: all
all:
	(make sass & make server & wait)

.PHONY: css
css:
	mkdir -p bundle
	postcss --watch --use autoprefixer --use postcss-import css/index.css --output bundle/index.css

.PHONY: server
server:
	browser-sync start --server --files='index.html, css/*.css, js/*.js, template/*.html'

.PHONY: sass
sass:
	node-sass --watch ./sass -o ./css

.PHONY: clean
clean:
	rm -r bundle
