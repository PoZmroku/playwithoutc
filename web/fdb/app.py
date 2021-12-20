from flask import Flask, render_template, url_for, request, redirect
from flask_sqlalchemy import SQLAlchemy
from datetime import datetime




app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///test.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)



class Article(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(100), nullable=False)
    intro = db.Column(db.String(300), nullable=False)
    text = db.Column(db.Text, nullable=False)
    date = db.Column(db.DateTime, default=datetime.utcnow)


    def __repr__(self):
        return '<Article %r>' % self.id


db.create_all()


@app.route('/')
@app.route('/index.html')
def index():
    articles = Article.query.order_by(Article.date.desc()).all()
    return render_template("index.html", articles=articles)


@app.route('/aboutas.html')
def about():
    return render_template("aboutas.html")


@app.route('/signinpage.html', methods=['POST', 'GET'])
def signin():
    return render_template("signinpage.html")


@app.route('/article_detail.html/<int:id>')
def post_detail(id):
    article = Article.query.get(id)
    return render_template("article_detail.html", article=article)


@app.route('/create-article.html', methods=['POST', 'GET'])
def create_article():
    if request.method == "POST":
        title = request.form['title']
        intro = request.form['intro']
        text = request.form['text']

        article = Article(title=title, intro=intro, text=text)

        try:
            db.session.add(article)
            db.session.commit()
            return redirect('/')
        except:
            return "Добавить статью не получилось :("


    else:
        return render_template("create-article.html")


if __name__ == "__main__":
    app.run(debug=True)