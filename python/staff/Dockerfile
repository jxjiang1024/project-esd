FROM python:3
WORKDIR /usr/src/app
COPY requirements.txt ./
RUN pip install --no-cache-dir -r requirements.txt
COPY ["staff.py","roles.py", "./"]
CMD [ "python", "./staff.py" ]